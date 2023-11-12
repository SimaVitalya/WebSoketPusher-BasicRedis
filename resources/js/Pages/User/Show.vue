<template>
  <div class="p-6 text-center">
    <div class="mb-4">
      User {{ user.name }}
    </div>
    <div>
      <a href="#" @click.prevent="sendLike" class="rounded-full border border-gray-400">SendLike</a>
    </div>
    <div v-if="like_str">
      {{ like_str }}
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "Show",
  props: [
    'user'
  ],
  data() {
    return {
      like_str: '',
    }
  },
  created() {
    // console.log(this.$page.props.auth.user.id)
    window.Echo.private(`send_like_${this.$page.props.auth.user.id}`)
    .listen('.send_like',res=>{
      // console.log(res);
      this.like_str = res.like_str
    })
  },
  methods: {
    sendLike() {
      axios.post(`/users/${this.user.id}`,{from_id:this.$page.props.auth.user.id})
      .then(res=>{
        this.like_str =res.data.like_str
      })
    }
  }
}
</script>
