<?php

namespace App\Http\Livewire\AturanAsosiasi;

use App\Models\AturanAsosiasi3item;
use App\Models\Hitung;
use Livewire\Component;

class RuleTigaItem extends Component
{
    public $perLoadRule3 = 10;
    public $sortByConsequentRule3 = false;
    public $sortByDefaultRule3 = false;
    public $perLoadfilterByConsequentRule3 = 10;

    public function render()
    {
        $aturanAsosiasiFinal3Items = AturanAsosiasi3item::take($this->perLoadRule3)->get();
        //sort by Consequent
        $datas = AturanAsosiasi3item::all();
        $filterByConsequentRule3 = [];
        foreach ($datas as $data) {
            $filterByConsequentRule3[$data->consequent_text][$data->antecedent_text] = $data->antecedent_text;
        }

        $stopLoadRule3 = AturanAsosiasi3item::count();

        //load
        $stopLoadfilterByConsequentRule3 = count($filterByConsequentRule3);
        $collection = collect($filterByConsequentRule3);
        $chunk = $collection->take($this->perLoadfilterByConsequentRule3);
        $filterByConsequentRule3 = $chunk->all();

        $find = Hitung::latest()->first();

        return view(
            'livewire.aturan-asosiasi.rule-tiga-item',
            [
                'aturanAsosiasiFinal3Items' => $aturanAsosiasiFinal3Items,
                'stopLoadRule3' => $stopLoadRule3,
                'filterByConsequentRule3' => $filterByConsequentRule3,
                'stopLoadfilterByConsequentRule3' => $stopLoadfilterByConsequentRule3,

                'min_support' => $find->min_support,
                'min_confidence' => $find->min_confidence,
            ]
        );
    }
    public function loadRule3()
    {
        $this->perLoadRule3 += 10;
    }
    public function showbyConsequentRule3()
    {
        $this->sortByConsequentRule3 = true;
        $this->sortByDefaultRule3 = false;
    }

    public function showSortByDefaultRule3()
    {
        $this->sortByDefaultRule3 = true;
        $this->sortByConsequentRule3 = false;
    }

    public function loadfilterByConsequentRule3()
    {
        $this->perLoadfilterByConsequentRule3 += 10;
    }
}
