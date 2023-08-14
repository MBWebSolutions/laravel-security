<?php

namespace App\Http\Controllers;

use App\Models\cve;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {

            $query = cve::query();
            //$cves = cve::paginate(10);

            if ($request->has('search')) {
                $query->where('description', 'like', '%' . $request->input('search') . '%');
            }


            $cves = $query->paginate(10);
        } catch (Exception $ex) {
            dd($ex);
        }
        return view('cve.index', ['cves' => $cves]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cve.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ini_set('max_execution_time', 180);


        $validated = $request->validate([
            'cpe_name' => 'required'
        ]);

        $input = $request->input();

        try {

            $oldCves = cve::all();

            $oldCvesArray = $oldCves->pluck('id', 'id_cve')->toArray();

            $response = Http::timeout(30)->get('https://services.nvd.nist.gov/rest/json/cves/2.0?cpeName=' . $input['cpe_name']);
            $data = $response->json();

            //$dataDecoded = json_decode($data);
            $dataDecoded = $data;

            //dd($oldCvesArray);

            $definitions = $dataDecoded['vulnerabilities'];

            foreach ($definitions as $vulnerability) {

                //DB::beginTransaction();

                if (!isset($oldCvesArray[$vulnerability['cve']['id']])) {
                    //dd($vulnerability['cve']['id']);

                    $urlReferences = [];

                    foreach ($vulnerability['cve']['references'] as $reference) {
                        $urlReferences[] = $reference['url'];
                    }

                    $url_recerences = implode(',', $urlReferences);

                    $cveArr = [
                        'id_cve' => $vulnerability['cve']['id'],
                        'description' => $vulnerability['cve']['descriptions'][0]['value'],
                        'last_update' => $vulnerability['cve']['lastModified'],
                        'publication_date' => $vulnerability['cve']['published'],
                        'threat' => $vulnerability['cve']['weaknesses'][0]['description'][0]['value'],
                        'threat_score' => $vulnerability['cve']['metrics']['cvssMetricV2'][0]['cvssData']['baseScore'],
                        'url_recerences' => $url_recerences,
                        'json' => json_encode($vulnerability)
                    ];

                    //dd($cveArr);
                    //cve::create($cveArr);

                    $NewCve = new cve();
                    $NewCve->id_cve = $cveArr['id_cve'];
                    $NewCve->description = $cveArr['description'];
                    $NewCve->last_update = $cveArr['last_update'];
                    $NewCve->publication_date = $cveArr['publication_date'];
                    $NewCve->threat = $cveArr['threat'];
                    $NewCve->threat_score = $cveArr['threat_score'];
                    $NewCve->url_recerences = $cveArr['url_recerences'];
                    $NewCve->json = json_encode($cveArr['json']);
                    $NewCve->save();
                }

                //DB::commit();
            }


            return redirect('/dashboard');
        } catch (Exception $ex) {
            //DB::rollBack();
            dd($ex);
            Log::error('Error cve', $ex);
            return redirect()->back()->with('errors', ['Error with storing the response']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cve = cve::where('id', $id)->first();

        $response = Http::get('https://services.nvd.nist.gov/rest/json/cvehistory/2.0?cveId=' . $cve['id_cve']);
        $data = $response->json();

        $changes = [];
        //dd($data);
        foreach ($data['cveChanges'] as $change) {

            $array = [
                'eventName' => (isset($change['change']['eventName'])) ? $change['change']['eventName'] : '',
                'cveChangeId' => (isset($change['change']['cveChangeId'])) ? $change['change']['cveChangeId'] : '',
                'created' => (isset($change['change']['created'])) ? $change['change']['created'] : '',
                'details' => []

            ];

            foreach ($change['change']['details'] as $detail) {

                $array['details'][] = [
                    "action" => $detail["action"],
                    "type" => $detail["type"],
                    "newValue" => (isset($detail["newValue"])) ? $detail["newValue"] : ''
                ];
            }

            $changes[] = $array;
        }
        return view('cve.show', ['cve' => $cve, 'changes' => $changes]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cve $cve)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cve $cve)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cve $cve)
    {
        //
    }
}
