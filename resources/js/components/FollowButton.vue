<template>
 <div>
    <form @submit.prevent="send" class="">
     <input type="hidden" name="_token" v-bind:value="csrf">
     <div v-if="following_check">
       <button type="submit" class="btn btn-danger">フォロー解除</button>
     </div>
     <div v-else>
       <button type="submit" class="btn btn-primary">フォロー</button>
     </div>
    </form>
 </div>
</template>

<script>
    export default {
        data() {
            return {
                url: '',
                following_check: false,
            }
        },
        props: ['login_user_id', 'user_id', 'csrf', 'following', 'followed'],
        computed: {
            following_check: {
                get () { this.following_check },
                set () { this.check_follow() }
            }
        },
        created() {
            this.first_check()
        },
        methods: {
            first_check() {
                if(this.following == 1) {
                    this.following_check = true
                }
            },
            check_follow() {
                this.$store.dispatch('follow/follow_check', this.user_id)
            },
            send() {
                this.$store.dispatch('follow/follow', this.user_id)
                this.check_follow()
                this.following_check = !this.following_check
            },
        },
            method() {
                console.log(this.check_follow())
            }
    }
</script>