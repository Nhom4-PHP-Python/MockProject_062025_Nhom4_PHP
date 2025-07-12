<tbody>
    @forelse($parties as $idx => $party)
        <tr>
            <td>#{{ $idx + 1 }}</td>
            <td>{{ $party['relationship'] }}</td>
            <td>{{ $party['fullname'] }}</td>
            <td>{{ $party['statement'] ?? '' }}</td>
            <td class="text-center">
                <a href="{{ route('report.party.edit', $idx) }}" class="text-primary me-2" title="Edit"><i
                        class="bi bi-pencil-square"></i></a>
                <a href="{{ route('report.party.delete', $idx) }}" class="text-danger delete-icon"
                    data-url="{{ route('report.party.delete', $idx) }}" title="Delete"><i class="bi bi-trash"></i></a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">No relevant parties added</td>
        </tr>
    @endforelse
</tbody>
