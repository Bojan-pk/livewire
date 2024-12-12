<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th, td {
        padding: 5px;
        text-align: center;
    }

    th {
        font-weight: bold;
    }
</style>
<h4>ПРЕДЛОГ ЗА ДОНОШЕЊЕ ФОРМАЦИЈЕ</h4>
<table class="table-auto w-full mt-4">
    <thead>
        <tr>
            <th>Р.Б</th>
            <th>Н А И М Е Н О В А Њ Е</th>
            <th>Број изв.</th>
            <th>ВЕС</th>
            <th>Чин</th>
            <th>ПГ</th>
            <th>Група РМ</th>
            <th>Број бодова</th>
            <th>НН звање</th>
            <th>НАПОМЕНА</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cart as $item)
        <tr>
            <td>{{ $item['rb'] }}</td>
            <td>{{ $item['newJobName'] }}</td>
            <td></td>
            <td>{{ $item['ves'] }}</td>
            <td>{{ $item['fc'] }}</td>
            <td>{{ $item['pg'] }}</td>
            <td></td>
            <td>{{ $item['bb'] }}</td>
            {{-- <td>{{ implode(', ', $item['jobs'] ?? []) }}</td>
            <td>{{ implode(', ', $item['educations'] ?? []) }}</td>
            <td>{{ implode(', ', $item['conditions'] ?? []) }}</td>
            <td>{{ implode(', ', $item['experiences'] ?? []) }}</td>--}}
            {{-- <td>{{ $item['rulebooks']}}</td>  --}}
            
        </tr>
        @endforeach
    </tbody>
</table>
