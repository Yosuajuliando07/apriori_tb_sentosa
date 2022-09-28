<?php

namespace App\Http\Livewire\AturanAsosiasi;

use App\Models\AturanAsosiasi2item;
use App\Models\Hitung;
use Livewire\Component;

class RuleDuaItem extends Component
{
    public $perLoadRule2 = 10;
    public $sortByConsequentRule2 = false;
    public $sortByDefaultRule2 = false;
    public $perLoadfilterByConsequentRule2 = 10;

    public function render()
    {
        $aturanAsosiasiFinal2Items = AturanAsosiasi2item::take($this->perLoadRule2)->get();
        //sort by Consequent
        $datas = AturanAsosiasi2item::all();
        $filterByConsequentRule2 = [];
        foreach ($datas as $data) {
            $filterByConsequentRule2[$data->consequent_text][$data->antecedent_text] = $data->antecedent_text;
        }

        $stopLoadRule2 = AturanAsosiasi2item::count();
        //load
        $stopLoadfilterByConsequentRule2 = count($filterByConsequentRule2);
        $collection = collect($filterByConsequentRule2);
        $chunk = $collection->take($this->perLoadfilterByConsequentRule2);
        $filterByConsequentRule2 = $chunk->all();

        $find = Hitung::latest()->first();

        return view(
            'livewire.aturan-asosiasi.rule-dua-item',
            [
                'aturanAsosiasiFinal2Items' => $aturanAsosiasiFinal2Items,
                'stopLoadRule2' => $stopLoadRule2,
                'filterByConsequentRule2' => $filterByConsequentRule2,
                'stopLoadfilterByConsequentRule2' => $stopLoadfilterByConsequentRule2,

                'min_support' => $find->min_support,
                'min_confidence' => $find->min_confidence,
            ]
        );
    }

    public function loadRule2()
    {
        $this->perLoadRule2 += 10;
    }
    public function showbyConsequentRule2()
    {
        $this->sortByConsequentRule2 = true;
        $this->sortByDefaultRule2 = false;
    }

    public function showSortByDefaultRule2()
    {
        $this->sortByDefaultRule2 = true;
        $this->sortByConsequentRule2 = false;
    }

    public function loadfilterByConsequentRule2()
    {
        $this->perLoadfilterByConsequentRule2 += 10;
    }
}
