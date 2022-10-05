
@include('common.components.alert')

<div class="mailFrom formSection ">   






{{-- 管理者 --}}
@can('admin')



@include('lines.components.mail.list_mail')
@include('lines.components.mail.new_mail')
@endcan

@can('comment')

@include('lines.components.mail.comment_list_mail')
@include('lines.components.mail.comment_new_mail')
@endcan


</div>