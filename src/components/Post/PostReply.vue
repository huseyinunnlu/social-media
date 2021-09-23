<template>
  <div class="post-reply my-3" style="font-size:14px; width:80%; margin-left:30px">
        <PostReplyItem v-for="reply in replies" @toggleInput="replyInput = !replyInput" :reply="reply" :key="reply.id" :_User="_User" class="my-2"/>
        <ReplyInput v-if="replyInput" :replyUsername="comment.user.username" :postId="comment.post_id" :replyUserId="comment.user.id" :replyCommentId="comment.id"/>
  </div>
</template>

<script>
import PostReplyItem from '@/components/Post/PostReplyItem.vue'
import ReplyInput from '@/components/Post/AddPostReply.vue'
import {mapGetters} from 'vuex'
export default {
    props:['replies','comment'],
        data(){
            return {
                replyInput:false,
            }
    },
    components:{
        ReplyInput,
        PostReplyItem,
    },
    computed:{
        ...mapGetters(['_User']),
    }
}
</script>
