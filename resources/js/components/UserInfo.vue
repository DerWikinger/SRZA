<template>
    <div class="card">
        <div class="card-header">
            <slot name="header"></slot>
        </div>
        <div class="card-body">
            <div>
                ID: {{ user.id }}
            </div>
            <div>
                Name: {{ user.name }}
            </div>
            <div>
                Email: {{ user.email }}
            </div>
            <slot name="role"></slot>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: {type: Object},
    }
}
</script>
