<?php

namespace App\Http\Livewire\AturanAsosiasi;

use Livewire\Component;
use App\Models\AturanAsosiasi2item;
use App\Models\AturanAsosiasi3item;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use App\Models\Hitung;
use Carbon\Carbon;

class HitungPolaTataLetak extends Component
{
    public $perLoadTransaksi = 10;

    public $perLoadKandidat1 = 10;
    public $perLoadlarge1 = 10;

    public $perLoadKandidat2 = 10;
    public $perLoadlarge2 = 10;

    public $perLoadKandidat3 = 10;
    public $perLoadlarge3 = 10;
    public function render()
    {
        $find = Hitung::latest()->first();
        // $ambilData = Transaksi::whereBetween('tgl_transaksi', ['2019-05-20', '2019-06-10'])->get();
        $ambilDataRange = Transaksi::whereBetween('tgl_transaksi', [$find->tanggal_awal, $find->tanggal_akhir])->get();
        // $totalTransaksi = $ambilDataRange->count();
        if ($ambilDataRange->count() > 0) {

            // MENCARI DATA TRANSAKSI YANG MEMILIKI KODE TRANSAKSI YANG SAMA
            $data_transaksi = [];
            foreach ($ambilDataRange as $dataRange) {
                foreach ($dataRange->transaksi_barang  as $dataBarangDiTransaksi) {
                    $data_transaksi[$dataRange->kode_transaksi][$dataBarangDiTransaksi->jenis_bahan_bangunan] = $dataBarangDiTransaksi->jenis_bahan_bangunan;
                }
            }

            // MENGAMBIL ATRIBUT JENIS BAHAN BANGUNAN
            $jenisBahan = [];
            foreach ($ambilDataRange as $t) {
                foreach ($t->transaksi_barang as $tp) {
                    $jenisBahan[] = $tp->jenis_bahan_bangunan;
                }
            }
            /**
             * collect() = Laravel collection adalah sebuah fitur bawaan laravel yang digunakan untuk mengolah data array
             * syntax    = collect(variabelArray);
             * reference = https://laravel.com/docs/9.x/collections#method-countBy
             */
            $kuantitasPerItem = collect($jenisBahan);
            $hasilKuantitasPerItem = $kuantitasPerItem->countBy();
            $hasilKuantitasPerItem = $hasilKuantitasPerItem->all();
            // dd($hasilKuantitasPerItem);


            //ITERASI 1
            /**
             *             ∑𝑇𝑟𝑎𝑛𝑠𝑎𝑘𝑠𝑖 𝑚𝑒𝑛𝑔𝑎𝑛𝑑𝑢𝑛𝑔 𝐴
             *𝑆𝑢𝑝𝑝𝑜𝑟𝑡(𝐴) = ------------------------ x 100%
             *             ∑𝑇𝑟𝑎𝑛𝑠𝑎𝑘𝑠𝑖
             */
            $kandidat1 = [];
            $large1 = [];
            foreach ($hasilKuantitasPerItem as $keyItr1 => $kuantitas1) {
                $kandidat1[] = [
                    "nama_item" => $keyItr1,
                    "jumlah" =>  $kuantitas1,
                    /**
                     * intval()  = digunakan untuk mengembalikan nilai integer variabel.
                     * syntax    = intval(variabel, base);
                     * reference = https://www.w3schools.com/php/func_var_intval.asp
                     *
                     * round()   = adalah fungsi pembulatan yang menghasilkan bilangan bulat terdekat dari bilangan aslinya
                     * syntax    = round(bilangan, presisi, mode);
                     * reference = https://www.w3schools.com/php/func_math_round.asp
                     */
                    'support_persen' => round(intval($kuantitas1) / count($data_transaksi) * 100, 2),
                ];
                //Melakukan prune atau pemangkasan
                if (round(intval($kuantitas1) / count($data_transaksi) * 100, 2) >= $find->min_support) {
                    //masuk jika melebihi latau sama dengan
                    $large1[] = [
                        "nama_item" => $keyItr1,
                        "jumlah" =>  $kuantitas1,
                        'support_persen' => round(intval($kuantitas1) / count($data_transaksi) * 100, 2),
                    ];
                }
            }

            //ITERASI 2
            //join terhadap dirinya sendiri
            $namaItemKombinasi = [];
            foreach ($large1 as $L1) {
                $namaItemKombinasi[] = $L1['nama_item'];
            }
            // Sumber = https://rachmat.id/articles/program-bintang-segitiga-php
            /**
             *               ∑𝑇𝑟𝑎𝑛𝑠𝑎𝑘𝑠𝑖 𝑚𝑒𝑛𝑔𝑎𝑛𝑑𝑢𝑛𝑔 𝐴, 𝐵
             *𝑆𝑢𝑝𝑝𝑜𝑟𝑡(𝐴, 𝐵) = ------------------------- x 100%
             *               ∑𝑇𝑟𝑎𝑛𝑠𝑎𝑘𝑠𝑖
             */
            $kandidat2 = [];
            $large2 = [];
            for ($a = 0; $a < count($namaItemKombinasi); $a++) {
                for ($b = $a + 1; $b < count($namaItemKombinasi); $b++) {
                    $nama_item = $namaItemKombinasi[$a] . ", " . $namaItemKombinasi[$b];
                    //MENCARI 2 ITEM YANG SAMA DI Array
                    $array2Item = explode(', ', $nama_item);
                    $penyimpanan = 0;

                    foreach ($ambilDataRange as $trans) {
                        $transaksiBarang = [];
                        $deteksi = true;
                        foreach ($trans->transaksi_barang as $tb) {
                            $transaksiBarang[] = $tb->jenis_bahan_bangunan;
                        }
                        foreach ($array2Item as $cari) {
                            if (in_array($cari, $transaksiBarang)) {
                                //https://www.stechies.com/php-inarray-function/
                                // PHP in_array() adalah fungsi PHP bawaan yang digunakan untuk memeriksa apakah ada nilai tertentu dalam Array atau tidak.
                                // $test += in_array("cari", $transaksiBarang);
                                $deteksi = true;
                            } else {
                                $deteksi = false;
                                break;
                            }
                        }

                        if ($deteksi == true) {
                            $penyimpanan = $penyimpanan + 1;
                        }
                    }

                    $kandidat2[] = [
                        "nama_item" => $nama_item,
                        "jumlah" => $penyimpanan,
                        "support_persen" => round(intval($penyimpanan) / count($data_transaksi) * 100, 2),
                    ];
                    //Melakukan prune atau pemangkasan
                    if (round(intval($penyimpanan) / count($data_transaksi) * 100, 2) >= $find->min_support) {
                        $large2[] = [
                            "nama_item" => $nama_item,
                            "array2Item" => $array2Item,
                            "jumlah" =>  $penyimpanan,
                            'support_persen' => round(intval($penyimpanan) / count($data_transaksi) * 100, 2),
                        ];
                    }
                }
            }
            //5 Januari 2022 - 6 Januari 2022

            // dd($kandidat2);

            //https://www.w3schools.com/php/func_array_search.asp
            //https://www.w3schools.com/php/func_array_column.asp


            /**
             *                  ∑𝑇𝑟𝑎𝑛𝑠𝑎𝑘𝑠𝑖 𝐴 𝑑𝑎𝑛 𝐵
             * 𝐶𝑜𝑛𝑓𝑖𝑑𝑒𝑛𝑐𝑒(𝐴|𝐵) = ----------------- X 100%
             *                  ∑𝑇𝑟𝑎𝑛𝑠𝑎𝑘𝑠𝑖 𝐴
             *
             *                    𝐶𝑜𝑛𝑓𝑖𝑑𝑒𝑛𝑐𝑒 (𝐴 ∩ 𝐵)
             * Lift Ratio (A,B) = ---------------------
             *                    𝐵𝑒𝑛𝑐ℎ𝑚𝑎𝑟𝑘 𝐶𝑜𝑛𝑓𝑖𝑑𝑒𝑛𝑐𝑒
             *
             *                       ∑𝑇𝑟𝑎𝑛𝑠𝑎𝑘𝑠𝑖 𝐵 (consequent)
             * Benchmark Confidence = ------------------------
             *                       ∑𝑇𝑟𝑎𝑛𝑠𝑎𝑘𝑠𝑖
             */

            // $var = array("a" => "red", "b" => "green", "c" => "blue");
            // $test =  array_search("red", $var);
            // a
            // dd($test);
            //Fungsi array_search() mencari sebuah array untuk sebuah nilai dan mengembalikan kuncinya / key.
            //array_column(array, column_key, index_key)
            //Fungsi array_column() mengembalikan nilai dari satu kolom dalam array input.

            $rule2itemset = [];
            foreach ($large2 as $item2) {
                $ruleText1 = "Jika membeli " . $item2["array2Item"][0] . " maka membeli " . $item2["array2Item"][1];
                //Mengambil jumlah dari array large, untuk antecedent
                $ambilIndex = array_search($item2["array2Item"][0], array_column($large1, "nama_item"));
                $rule1a = $large1[$ambilIndex]["jumlah"];

                // ====================================================================================================

                // Balik
                $ruleText2 = "Jika membeli " . $item2["array2Item"][1] . " maka membeli " . $item2["array2Item"][0];
                $ambilIndex = array_search($item2["array2Item"][1], array_column($large1, "nama_item"));
                $rule2a = $large1[$ambilIndex]["jumlah"];

                //Confidence = Total A, B / A(antecedent) * 100
                $confidence1 = $item2['jumlah'] /  intval($rule1a) * 100;
                // dd($confidence1);
                $totalAB1 = $item2['jumlah'] /  intval($rule1a);
                $benchmark1 = $rule2a / count($data_transaksi);
                $lift_ratio1 = $totalAB1 / $benchmark1;
                $rule2itemset[] = [
                    "rule" => $ruleText1,
                    "ab" => $item2["jumlah"],
                    "a" => $rule1a,
                    "b" => $rule2a,
                    "antecedent_text" => $item2["array2Item"][0],
                    "consequent_text" => $item2["array2Item"][1],
                    'support_persen' => round($item2["jumlah"] / count($data_transaksi) * 100, 2),
                    "confidence_persen" => round($confidence1, 2),
                    "lift_ratio" => round($lift_ratio1, 2),
                ];
                // ====================================================================================================
                $confidence2 = $item2['jumlah'] /  intval($rule2a) * 100;
                $totalAB2 = $item2['jumlah'] /  intval($rule2a);
                $benchmark2 = $rule1a / count($data_transaksi);
                $lift_ratio2 = $totalAB2 / $benchmark2;
                $rule2itemset[] = [
                    "rule" => $ruleText2,
                    "ab" => $item2["jumlah"],
                    "a" => $rule2a,
                    "b" => $rule1a,
                    "antecedent_text" => $item2["array2Item"][1],
                    "consequent_text" => $item2["array2Item"][0],
                    'support_persen' => round($item2["jumlah"] / count($data_transaksi) * 100, 2),
                    "confidence_persen" => round($confidence2, 2),
                    "lift_ratio" => round($lift_ratio2, 2),

                ];
            }

            // $namaItemKombinasi2 = [];
            // foreach ($large2 as $L2) {
            //     $namaItemKombinasi2[] = $L2['nama_item'];
            // }
            // dd($namaItemKombinasi2);


            // $var = [];
            // $data = ['merah', 'kuning', 'hijau', 'biru', 'hitam', 'ungu'];
            // // dd(count($a));

            // for ($a = 0; $a < count($data); $a++) {
            //     for ($b = $a + 1; $b < count($data); $b++) {
            //         for ($c = $b + 1; $c < count($data); $c++) {
            //             $var[] = $data[$a]  . ', ' .  $data[$b] . ', ' .  $data[$c];
            //         }
            //     }
            // }

            $kandidat3 = [];
            $large3 = [];
            for ($a = 0; $a < count($namaItemKombinasi); $a++) {
                for ($b = $a + 1; $b < count($namaItemKombinasi); $b++) {
                    for ($c = $b + 1; $c < count($namaItemKombinasi); $c++) {
                        $nama_item = $namaItemKombinasi[$a] . ", " . $namaItemKombinasi[$b] . ", " . $namaItemKombinasi[$c];
                        $array3Item = explode(', ', $nama_item);
                        $penyimpanan = 0;

                        foreach ($ambilDataRange as $trans) {
                            $transaksiBarang = [];
                            $deteksi = true;

                            foreach ($trans->transaksi_barang as $tp) {
                                $transaksiBarang[] = $tp->jenis_bahan_bangunan;
                            }

                            foreach ($array3Item as $cari) {
                                if (in_array($cari, $transaksiBarang)) {
                                    $deteksi = true;
                                } else {
                                    $deteksi = false;
                                    break;
                                }
                            }

                            if (
                                $deteksi == true
                            ) {
                                $penyimpanan = $penyimpanan + 1;
                            }
                        }
                        $kandidat3[] = [
                            "nama_item" => $nama_item,
                            "jumlah" => $penyimpanan,
                            "support_persen" => round(intval($penyimpanan) / count($data_transaksi) * 100, 2),
                        ];
                        //Melakukan prune atau pemangkasan
                        if (round(intval($penyimpanan) / count($data_transaksi) * 100, 2) >= $find->min_support) {
                            $large3[] = [
                                "nama_item" => $nama_item,
                                "array3Item" => $array3Item,
                                "jumlah" =>  $penyimpanan,
                                'support_persen' => round(intval($penyimpanan) / count($data_transaksi) * 100, 2),
                            ];
                        }
                    }
                }
            }
            // dd($large3);
            /**
             *                   ∑𝑇𝑟𝑎𝑛𝑠𝑎𝑘𝑠𝑖 𝑚𝑒𝑛𝑔𝑎𝑛𝑑𝑢𝑛𝑔 𝐴, 𝐵, C
             *𝑆𝑢𝑝𝑝𝑜𝑟𝑡(𝐴, 𝐵, C) = ------------------------- x 100%
             *                   ∑𝑇𝑟𝑎𝑛𝑠𝑎𝑘𝑠𝑖
             */

            /**
             *                  ∑𝑇𝑟𝑎𝑛𝑠𝑎𝑘𝑠𝑖 𝐴, 𝐵, C
             * 𝐶𝑜𝑛𝑓𝑖𝑑𝑒𝑛𝑐𝑒(𝐴|𝐵|C) = ----------------- X 100%
             *                  ∑𝑇𝑟𝑎𝑛𝑠𝑎𝑘𝑠𝑖 𝐴, 𝐵
             *
             *
             *                    𝐶𝑜𝑛𝑓𝑖𝑑𝑒𝑛𝑐𝑒 (𝐴 ∩ 𝐵 ∩ C)
             * Lift Ratio (A,B,C) = ---------------------
             *                    𝐵𝑒𝑛𝑐ℎ𝑚𝑎𝑟𝑘 𝐶𝑜𝑛𝑓𝑖𝑑𝑒𝑛𝑐𝑒
             *
             *                       ∑𝑇𝑟𝑎𝑛𝑠𝑎𝑘𝑠𝑖 C (consequent)
             * Benchmark Confidence = ------------------------
             *                       ∑𝑇𝑟𝑎𝑛𝑠𝑎𝑘𝑠𝑖
             */
            $rule3itemset = [];
            foreach ($large3 as $item3) {
                for ($a = 0; $a < count($item3["array3Item"]); $a++) {
                    for ($b = $a + 1; $b < count($item3["array3Item"]); $b++) {
                        $cari2Item = $item3["array3Item"][$a] . ", " . $item3["array3Item"][$b];
                        // dd($cari2Item);

                        $ambilIndex = array_search($cari2Item, array_column($large2, "nama_item"));
                        //array array_search => return key
                        //array_column => mengembalikan nilai pada sebuah kolom tunggal yang ada didalam array multi dimensi
                        $rule3ab = $large2[$ambilIndex]["jumlah"];

                        // dd($rule3ab);

                        $arr = [];
                        $arr[] = $item3["array3Item"][$a]; //0
                        $arr[] = $item3["array3Item"][$b]; //1
                        $diff = array_diff($item3["array3Item"], $arr); //2
                        //                           data array, data array

                        // dd($arr);
                        //Array to string conversion
                        // $rule3then = [];
                        //mengeluarkan dari array
                        foreach ($diff as $d) {
                            $rule3maka = $d;
                        }

                        $ambilIndex = array_search($rule3maka, array_column($large1, "nama_item"));
                        $totalConsequent = $large1[$ambilIndex]["jumlah"];

                        $totalABC = $item3["jumlah"] / $rule3ab;
                        $benchmark = $totalConsequent / count($data_transaksi);
                        $lift_ratio =   $totalABC / $benchmark;

                        $rule3itemset[] = [
                            "rule" => "Jika membeli " . $item3["array3Item"][$a] . " dan " . $item3["array3Item"][$b] . " maka membeli " . $rule3maka,
                            "abc" => $item3["jumlah"], //jumlah semuanya (a,b,c)
                            "ab" => $rule3ab, //total antecedent
                            'c' => $totalConsequent, //total consequent
                            'antecedent_text' => $item3["array3Item"][$a] . ", " . $item3["array3Item"][$b],
                            'consequent_text' => $rule3maka,
                            "support_persen" => round($item3["jumlah"] / count($data_transaksi) * 100, 2),
                            "confidence_persen" =>  round($item3["jumlah"] / $rule3ab * 100),
                            "lift_ratio" =>  round($lift_ratio, 2),
                        ];
                    }
                }
            }

            // ===========================================================================================================================
            // ATURAN ASOSIASI

            if (count($rule2itemset) > 0) {
                DB::table('aturan_asosiasi_2_items')->delete();
                foreach ($rule2itemset as $key => $asosiasi) {
                    // jika nilai di diatas atau sama dengan batasan minimum confidence
                    if ($asosiasi['confidence_persen'] >= $find->min_confidence) {
                        //mendefinisikan nilai lift ratio (korelasi lift)
                        if ($asosiasi['lift_ratio'] == 1) {
                            $lift_ratio = "tidak ada korelasi";
                        } elseif ($asosiasi['lift_ratio'] < 1) {
                            $lift_ratio = "korelasi negatif";
                        } else {
                            $lift_ratio = "korelasi positif";
                        }
                        AturanAsosiasi2item::create([
                            "rule" => $asosiasi['rule'],
                            "total_ab" => $asosiasi['ab'],
                            "total_antecedent" => $asosiasi['a'],
                            "total_consequent" => $asosiasi['b'],
                            "antecedent_text" => $asosiasi['antecedent_text'],
                            "consequent_text" => $asosiasi['consequent_text'],
                            "lift_ratio_text" => $lift_ratio,
                            "support_persen" => $asosiasi['support_persen'],
                            "confidence_persen" => $asosiasi['confidence_persen'],
                            'hitung_id' => $find->id,
                        ]);
                    }
                }
            }


            if (count($rule3itemset) > 0) {
                DB::table('aturan_asosiasi_3_items')->delete();
                foreach ($rule3itemset as $key => $asosiasi) {
                    // jika nilai di diatas atau sama dengan batasan minimum confidence
                    if ($asosiasi['confidence_persen'] >= $find->min_confidence) {
                        //mendefinisikan nilai lift ratio (korelasi lift)
                        if ($asosiasi['lift_ratio'] == 1) {
                            $lift_ratio = "tidak ada korelasi";
                        } elseif ($asosiasi['lift_ratio'] < 1) {
                            $lift_ratio = "korelasi negatif";
                        } else {
                            $lift_ratio = "korelasi positif";
                        }
                        AturanAsosiasi3item::create([
                            "rule" => $asosiasi['rule'],
                            "total_abc" => $asosiasi['abc'],
                            "total_antecedent" => $asosiasi['ab'],
                            "total_consequent" => $asosiasi['c'],
                            "antecedent_text" => $asosiasi['antecedent_text'],
                            "consequent_text" => $asosiasi['consequent_text'],
                            "lift_ratio_text" => $lift_ratio,
                            "support_persen" => $asosiasi['support_persen'],
                            "confidence_persen" => $asosiasi['confidence_persen'],
                            'hitung_id' => $find->id,
                        ]);
                    }
                }
            }
            // ===========================================================================================================================
            // END ATURAN ASOSIASI

            /**
             * https://carbon.nesbot.com/docs/
             */

            $tglAwal = Carbon::parse($find->tanggal_awal)->isoFormat('D MMMM Y');
            $tglAkhir = Carbon::parse($find->tanggal_akhir)->isoFormat('D MMMM Y');
            // dd($tglAkhir);
        } else {
            // Alert::toast('Data Tidak Tersedia!', 'error');
            return redirect()->back();
        }
        // $data_transaksi = Article::paginate($this->perLoadTransaksi);

        //https://laravel.com/docs/9.x/collections#method-take
        $stopLoadTransaksi = count($data_transaksi);
        $collection = collect($data_transaksi);
        $chunk = $collection->take($this->perLoadTransaksi);
        $data_transaksi = $chunk->all();
        // dd($data_transaksi);

        $stopLoadKandidat1 = count($kandidat1);
        $collection = collect($kandidat1);
        $chunk = $collection->take($this->perLoadKandidat1);
        $kandidat1 = $chunk->all();
        // dd($kandidat1);

        $stopLoadLarge1 = count($large1);
        $collection = collect($large1);
        $chunk = $collection->take($this->perLoadlarge1);
        $large1 = $chunk->all();
        // dd($large1);

        $stopLoadKandidat2 = count($kandidat2);
        $collection = collect($kandidat2);
        $chunk = $collection->take($this->perLoadKandidat2);
        $kandidat2 = $chunk->all();
        // dd($kandidat2);

        $stopLoadLarge2 = count($large2);
        $collection = collect($large2);
        $chunk = $collection->take($this->perLoadlarge2);
        $large2 = $chunk->all();
        // dd($large2);


        $stopLoadKandidat3 = count($kandidat3);
        $collection = collect($kandidat3);
        $chunk = $collection->take($this->perLoadKandidat3);
        $kandidat3 = $chunk->all();
        // dd($kandidat3);

        $stopLoadLarge3 = count($large3);
        $collection = collect($large3);
        $chunk = $collection->take($this->perLoadlarge3);
        $large3 = $chunk->all();
        // dd($large2);

        return view(
            'livewire.aturan-asosiasi.hitung-pola-tata-letak',
            [
                'tglAwal' => $tglAwal,
                'tglAkhir' => $tglAkhir,
                'min_support' => $find->min_support,
                'min_confidence' => $find->min_confidence,


                'data_transaksi' => $data_transaksi,
                'stopLoadTransaksi' => $stopLoadTransaksi,

                'kandidat1' => $kandidat1,
                'stopLoadKandidat1' => $stopLoadKandidat1,

                'large1' => $large1,
                'stopLoadLarge1' => $stopLoadLarge1,



                'kandidat2' => $kandidat2,
                'stopLoadKandidat2' => $stopLoadKandidat2,

                'large2' => $large2,
                'stopLoadLarge2' => $stopLoadLarge2,

                'kandidat3' => $kandidat3,
                'stopLoadKandidat3' => $stopLoadKandidat3,

                'large3' => $large3,
                'stopLoadLarge3' => $stopLoadLarge3,

            ]
        )->extends('layouts.app', ['title' => 'Pola Penjualan Produk | Hasil Perhitungan'])->section('content');
    }
    public function loadDataTransaksi()
    {
        $this->perLoadTransaksi += 10;
    }

    public function loadKandidat1()
    {
        $this->perLoadKandidat1 += 10;
    }

    public function loadLarge1()
    {
        $this->perLoadlarge1 += 10;
    }

    public function loadKandidat2()
    {
        $this->perLoadKandidat2 += 10;
    }

    public function loadLarge2()
    {
        $this->perLoadlarge2 += 10;
    }

    public function loadKandidat3()
    {
        $this->perLoadKandidat3 += 10;
    }

    public function loadLarge3()
    {
        $this->perLoadlarge3 += 10;
    }
}
