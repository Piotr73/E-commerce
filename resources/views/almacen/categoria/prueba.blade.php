<table>
    <tr>
        <td>Order No.</td>
        <td>Order Item Name</td>
        <td>Order Item Price</td>
        <td>User</td>
        <td>User Email</td>
    </tr>
    @foreach($orderItems as $orderItem )
        <tr>
            <td>{{ $orderItem->idcred }}</td>
            <td>{{ $orderItem->cliente }}</td>
        </tr>
    @endforeach
</table>