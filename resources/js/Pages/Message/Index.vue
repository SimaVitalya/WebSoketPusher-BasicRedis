<template>
  <div class="w-1/2 mx-auto py-6">
    <div>
      <div class="mb-4">
        <input v-model="body" class="rounded-full border border-gray-400" type="text" placeholder="your message">
      </div>
      <div class="mb-4">
        <a @click.prevent="store" href="#" class="rounded-lg block w-48 bg-sky-400 text-white text-center py-2">Send</a>
      </div>
    </div>
    <div v-if="messages.length" class="mb-4">
      <h3>Messages</h3>
      <div class="pt-4">
        <div class="text-sm pb-4 mb-4 border-b border-gray-300" v-for="message in messages">
          <p>{{ message.id }}</p>
          <p>{{ message.body }}</p>
          <p class="text-right">{{ message.time }}</p>
        </div>
      </div>
    </div>

  </div>
</template>
<script>

import axios from "axios";

export default {
  name: "Index.vue",
  props: [
    'messages'
  ],
  data() {
    return {
      body: '',
    }
  },
  created() {
  window.Echo.channel('store_message')
    .listen('.store_message',res =>{
      // console.log(res);
      this.messages.unshift(res.message)//сосдаем через вебсокет

    })
  },
  methods: {
    store() {
      axios.post('/messages', {body: this.body})
          .then(res => {
            this.messages.unshift(res.data)
            this.body = '';
          })
    }
  }
}
</script>
