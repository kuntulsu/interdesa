<div>
    <table>
        <thead>
            <th>Profile Name</th>
            <th>Harga</th>
        </thead>
        <tbody>
            @foreach ($profiles as $profile)
                <tr>
                    <td>{{ $profile['name'] }}</td>
                    <td>
                        @if (!is_null($profile['local_profile']))
                            {{ $profile['local_profile']['price'] }}
                        @else
                            0
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
