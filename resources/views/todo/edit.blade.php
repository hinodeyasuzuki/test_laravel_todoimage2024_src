<x-appedit-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            TODO編集
        </h2>

    </x-slot>

    <div class="py-12">
        <form action="{{ route('todo.update', ['todo' => $todo->id]) }}" method="post">
            @csrf
            @method('PUT')
            <table>
                <tr>
                    <th>タイトル</th>
                    <td><input type="text" name="title" value="{{ $todo->title }}"></td>
                </tr>
                <tr>
                    <th>概要</th>
                    <td>
                        <textarea id="editor" name="description">{{ $todo->description }}</textarea>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="id" value="{{ $todo->id }}">
            <a href="{{ route('todo.index') }}" class="button">戻る</a>
            <button type="submit">更新</button>
        </form>
    </div>

</x-appedit-layout>