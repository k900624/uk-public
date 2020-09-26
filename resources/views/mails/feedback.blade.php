@isset($feedback->subject)
    <h3>{{ $feedback->subject }}</h3>
@endisset
<table>
    @isset($feedback->name)
    <tr>
        <td>Пользователь</td>
        <td>{{ $feedback->name }}</td>
    </tr>
    @endisset
    @isset($feedback->ip_address)
    <tr>
        <td>Ip_address</td>
        <td>{{ $feedback->ip_address }}</td>
    </tr>
    @endisset
    @isset($feedback->email)
    <tr>
        <td>Email</td>
        <td>{{ $feedback->email }}</td>
    </tr>
    @endisset
    @isset($feedback->answer)
        <tr>
            <td>Ответ</td>
            <td>{{ $feedback->answer }}</td>
        </tr>
    @endisset
    @isset($feedback->message)
    <tr>
        <td>Сообщение</td>
        <td>{{ $feedback->message }}</td>
    </tr>
    @endisset
</table>




