<div class="card">
    <div class="card-body">
        <user-contacts :contacts="{{ collect($user->contacts)->map(function ($contact) {
    $user = $contact->user;
    return [
        'name' => $user->name,
        'id' => $user->id,
        'email' => $user->email,
        'avatar' => $user->avatar,
        'nickname' => $user->nickname,
        ]; }) }}"></user-contacts>
    </div>
</div>
<script>
    import UserContacts from "../../js/components/profile/UserContacts";
    export default {
        components: {UserContacts}
    }
</script>
