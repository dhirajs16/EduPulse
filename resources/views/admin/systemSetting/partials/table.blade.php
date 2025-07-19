@foreach ($systemSettings as $systemSetting)
    <tr>
        <td>{{ $systemSetting->id }}</td>
        <td>{{ $systemSetting->key }}</td>
        <td>{{ $systemSetting->value }}</td>
        <td>{{ $systemSetting->description }}</td>
        <td>{{ $systemSetting->status }}</td>
        <td>{{ $systemSetting->code }}</td>
        <td class="d-flex fs-5 gap-2">
            <a class="text-decoration-none" href="{{ route('admin.system-settings.edit', $systemSetting->id) }}">
                <i class="bi bi-pencil-square"></i>
            </a>
            <form id="deleteForm"  action="{{ route('admin.system-settings.destroy', $systemSetting->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-link p-0 text-decoration-none text-danger" type="submit"
                    onclick="return confirm('Are you sure you want to delete this systemSetting?')">
                    <i class="bi bi-trash3"></i>
                </button>
            </form>
        </td>
    </tr>
@endforeach
<tr>
    <td>
        {!! $systemSettings->links('admin.layouts.custom-pagination') !!}
    </td>


</tr>
