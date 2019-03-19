<table class="table table-hover mb-0">
    <caption class="pb-0 ml-2 mb-2">
        {{ $result[$type]->count() }} {{ str_plural(str_singular($type), $result[$type]->count()) }} found
    </caption>
    <colgroup>
        <col>
        <col width="100">
    </colgroup>
    <thead>
        <tr>
            <th>Name</th>
            <th class="text-center">Points</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($result[$type] as $achievement)
            <tr>
                <td>
                    <a href="{{ route('db.achievements.show', $achievement->slug) }}">{{ $achievement->name }}</a>
                </td>
                <td class="text-center">
                    {{ $achievement->points }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
