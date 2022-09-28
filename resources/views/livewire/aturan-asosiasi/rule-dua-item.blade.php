 {{-- ATURAN ASOSIASI 2 --}}
 @if (count($aturanAsosiasiFinal2Items) > 0)
     <div class="min-height-200px">
         <div class="pd-20 card-box mb-30">
             <div class="clearfix mb-20">
                 <div class="pull-left">
                     <h4 class="text-blue h4">ATURAN ASOSIASI (Rule 2-itemset)</h4>
                     <p class="mb-5">
                         <small>Aturan Asosiasi (Rule) yang memenuhi batasan Minimum Confidence
                             <strong>{{ $min_confidence }}%</strong>
                         </small>
                     </p>
                 </div>
                 <div class="pull-right">
                     <div class="dropdown show">
                         <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button"
                             data-toggle="dropdown" aria-expanded="true">
                             Aksi Lainnya
                         </a>
                         <div class="dropdown-menu dropdown-menu-right " x-placement="bottom-end"
                             style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(108px, 40px, 0px);">
                             @if ($sortByConsequentRule2 == false)
                                 <a class="dropdown-item" target="_blank" href="{{ route('cetak.2.item') }}">Cetak
                                     Laporan (PDF)</a>
                                 <button class="dropdown-item" wire:click.prevent="showbyConsequentRule2">Sort by
                                     Consequent</button>
                             @else
                                 <button class="dropdown-item" wire:click.prevent="showSortByDefaultRule2">Sort by
                                     Default</button>
                             @endif
                         </div>
                     </div>
                 </div>
             </div>




             @if ($sortByConsequentRule2 == true)
                 <table class="table table-bordered ">
                     <thead>
                         <tr>
                             <th scope="col">No</th>
                             <th scope="col" class="w-25">Consequent</th>
                             <th scope="col">Antecedent</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php $i = 0; ?>
                         @foreach ($filterByConsequentRule2 as $key => $data)
                             <?php $i++; ?>
                             <tr>
                                 <td>{{ $i }}</td>
                                 <td>{{ $key }}</td>
                                 <td>{{ implode(', ', $data) }}</td>
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
                 @if (count($filterByConsequentRule2) >= 10 && count($filterByConsequentRule2) != $stopLoadfilterByConsequentRule2)
                     <button wire:click.prevent="loadfilterByConsequentRule2"
                         class="btn btn-primary btn-sm btn-block">Tampilkan
                         Lebih
                         Banyak
                     </button>
                 @endif
             @else
                 <table class="table table-bordered">
                     <thead>
                         <tr>
                             <th scope="col">No </th>
                             <th scope="col">Rule</th>
                             <th scope="col">Support(%)</th>
                             <th scope="col">Confidence(%)</th>
                             <th scope="col">Lift Ratio</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php $i = 0; ?>
                         @foreach ($aturanAsosiasiFinal2Items as $AS2)
                             <?php $i++; ?>
                             <tr class="{{ $AS2['confidence_persen'] < $min_confidence ? 'table-danger' : '' }}">
                                 <td>{{ $i }}</td>
                                 <td>{{ $AS2['rule'] }}</td>
                                 <td>{{ $AS2['support_persen'] }}%</td>
                                 <td>{{ $AS2['confidence_persen'] }}%</td>
                                 <td>{{ ucwords($AS2['lift_ratio_text']) }} </td>
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
                 @if (count($aturanAsosiasiFinal2Items) >= 10 && count($aturanAsosiasiFinal2Items) != $stopLoadRule2)
                     <button wire:click.prevent="loadRule2" class="btn btn-primary btn-sm btn-block">Tampilkan
                         Lebih
                         Banyak
                     </button>
                 @endif
             @endif
         </div>
     </div>
 @else
     {{-- <div class="alert alert-warning" role="alert">
         Tidak Dapat Membentuk Aturan Asosiasi 2 Item, Batasan Min Support dan Min Confidence Tidak Terpenuhi!
     </div> --}}
     <div></div>
 @endif
 {{-- END ATURAN ASOSIASI 2 --}}
