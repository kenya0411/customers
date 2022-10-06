
@include('common.components.alert')

<div class="mailFrom formSection ">   






{{-- 管理者 --}}
@can('admin')



@include('lines.components.person.list_person')
@include('lines.components.person.new_person')
@endcan




</div>