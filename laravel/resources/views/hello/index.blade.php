<table>
    <tr>
        <th>名前</th>
        <th>商品名</th>
        <th>値段</th>
    </tr>
    @foreach ($items as $item)
        <tr>
            <td>{{ $item->persons_name }}</td>
            <td>{{ $item->products_name }}</td>
            <td>{{ $item->products_price }}</td>
        </tr>
    @endforeach
</table>
