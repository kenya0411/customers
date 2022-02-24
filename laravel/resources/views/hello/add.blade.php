<form action="./add" method="post">
@csrf
<table>
    <tr>
        <th>name:</th>
        <td>
            @error('name')
                {{ $message }}<br>
            @enderror
            <input type="text" name="name" id="name" value="{{ old('name') }}">
        </td>
    </tr>
    <tr>
        <th>mail:</th>
        <td>
            @error('mail')
                {{ $message }}<br>
            @enderror
            <input type="text" name="mail" id="mail" value="{{ old('mail') }}">
        </td>
    </tr>
    <tr>
        <th>age</th>
        <td>
            @error('age')
                {{ $message }}<br>
            @enderror
            <input type="text" name="age" id="age" value="{{ old('age') }}">
        </td>
    </tr>
    <tr>
        <th></th>
        <td>
            <input type="submit" value="send">
        </td>
    </tr>
</table>
</form>
