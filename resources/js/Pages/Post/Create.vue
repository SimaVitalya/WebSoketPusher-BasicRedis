<template>
  <div class="mb-4 pt-6">
    <h3 class="text-xl">
      Add post

    </h3>
  </div>
  <div>
    <div>
      <div class="mb-4">
        <input @keyup="storeCache" class="border border-gray-500" type="text" v-model="title">
      </div>
      <div class="mb-4">
        <input @keyup="storeCache" class="border border-gray-500" type="text" v-model="content">
      </div>
      <div class="mb-4">
        <input @keyup="storeCache" class="border border-gray-500" type="text" v-model="days_for_create">
      </div>
      <div class="mb-4">
        <a @click.prevent="store" href="" class="inline-block px-3 py-2 border rounded text-white bg-sky-700">Add
          post</a>
      </div>
    </div>
  </div>
</template>
<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {t} from "../../../../public/build/assets/app-e37b0288.js";

export default {
  name: "Create.vue",
  layout: MainLayout,

  props: [
    'cache'
  ],
  //тут мы пропсом принимаем из бэкэнда compact и выводим его ниме в поле mounted там мы отображаем кеш если он есть
  data() {
    return {
      title: '',
      content: '',
      days_for_create: 0,
    }
  },
  mounted() {
    if (this.cache) {
      this.title = this.cache.title
      this.content = this.cache.content
      this.days_for_create = this.cache.days_for_create
    }
  },
  methods: {
    store() {
      axios.post('/postss', {
        title: this.title,
        content: this.content,
        days_for_create: this.days_for_create,
      }).then(res => {
        this.title = ''
        this.content = ''
        this.days_for_create = ''
        console.log(res)

      })
    },
    storeCache() {
      axios.post('/posts/cache', {
        title: this.title,
        content: this.content,
        days_for_create: this.days_for_create,
        user_id: 1
      }).then(res => {
        console.log(res)

      })
    }
  }
}
</script>


<style scoped>

</style>
