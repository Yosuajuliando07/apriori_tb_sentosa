<!DOCTYPE html>
<html>

<head>
    <title>Aturan Asosiasi 3 item</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 11pt;
        }
    </style>
    <center>
        <h4>{{ env('APP_NAME') }}</h4>
        <h5><a target="_blank" href="{{ env('APP_URL') }}">Sistem Pengaturan Tata Letak Barang</a></h5>
        <h5>Toko Bangunan Sentosa</h5>
    </center>


    <div class="row ml-1 mt-5">
        <table>
            <tbody>
                <tr>
                    <td>Tanggal Transaksi</td>
                    <td>&nbsp;&nbsp;:&nbsp;</td>
                    <td>{{ $tglAwal }} - {{ $tglAkhir }}</td>
                </tr>
                <tr>
                    <td>Minimum Support</td>
                    <td>&nbsp;&nbsp;:&nbsp;</td>
                    <td>{{ $find->min_support }}&#37;</td>
                </tr>
                <tr>
                    <td>Minimum Confidence</td>
                    <td>&nbsp;&nbsp;:&nbsp;</td>
                    <td>{{ $find->min_confidence }}&#37;</td>
                </tr>
            </tbody>
        </table>
    </div>


    <table class='table table-bordered mt-3'>
        <thead>
            <tr class="table-active">
                <th scope="col">No </th>
                <th scope="col">Rule 3-itemset</th>
                <th scope="col">Support(&#37;)</th>
                <th scope="col">Confidence(&#37;)</th>
                <th scope="col">Lift Ratio</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($aturanAsosiasi as $AS3)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $AS3->rule }}</td>
                    <td>{{ $AS3->support_persen }}&#37;</td>
                    <td>{{ $AS3->confidence_persen }}&#37;</td>
                    <td>{{ ucwords($AS3->lift_ratio_text) }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
