 {{-- ATURAN ASOSIASI 3 --}}

 @if (count($aturanAsosiasiFinal3Items) > 0)
     <div class="min-height-200px">
         <div class="pd-20 card-box mb-30">
             <div class="clearfix mb-20">
                 <div class="pull-left">
                     <h4 class="text-blue h4">ATURAN ASOSIASI (Rule 3-itemset)</h4>
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
                             @if ($sortByConsequentRule3 == false)
                                 <a class="dropdown-item" target="_blank" href="{{ route('cetak.3.item') }}">Cetak
                                     Laporan (PDF)</a>
                                 <button class="dropdown-item" wire:click.prevent="showbyConsequentRule3">Sort by
                                     Consequent</button>
                             @else
                                 <button class="dropdown-item" wire:click.prevent="showSortByDefaultRule3">Sort by
                                     Default</button>
                             @endif
                         </div>
                     </div>
                 </div>
             </div>




             @if ($sortByConsequentRule3 == true)
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
                         @foreach ($filterByConsequentRule3 as $key => $data)
                             <?php $i++; ?>
                             <tr>
                                 <td>{{ $i }}</td>
                                 <td>{{ $key }}</td>
                                 <td>{{ implode(', ', $data) }}</td>
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
                 @if (count($filterByConsequentRule3) >= 10 && count($filterByConsequentRule3) != $stopLoadfilterByConsequentRule3)
                     <button wire:click.prevent="loadfilterByConsequentRule3"
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
                         @foreach ($aturanAsosiasiFinal3Items as $AS3)
                             <?php $i++; ?>
                             <tr class="{{ $AS3['confidence_persen'] < $min_confidence ? 'table-danger' : '' }}">
                                 <td>{{ $i }}</td>
                                 <td>{{ $AS3['rule'] }}</td>
                                 <td>{{ $AS3['support_persen'] }}%</td>
                                 <td>{{ $AS3['confidence_persen'] }}%</td>
                                 <td>{{ ucwords($AS3['lift_ratio_text']) }} </td>
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
                 @if (count($aturanAsosiasiFinal3Items) >= 10 && count($aturanAsosiasiFinal3Items) != $stopLoadRule3)
                     <button wire:click.prevent="loadRule3" class="btn btn-primary btn-sm btn-block">Tampilkan
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
