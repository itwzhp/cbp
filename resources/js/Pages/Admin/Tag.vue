<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
import axios from 'axios';

export default {
    name: 'Tag',
    components: {FontAwesomeIcon},
    props: {
        tag: {
            type: Object,
            required: true,
        }
    },
    emits: ['change'],
    data() {
        return {
            name: '',
        }
    },
    mounted() {
        this.name = this.tag.name;
    },
    methods: {
        deleteTag() {
            axios.delete('/admin/tags/' + this.tag.id).then(() => {
                this.$emit('change');
            })
        },
        updateTag() {
            axios.post('/admin/tags/' + this.tag.id, {
                'name': this.name
            }).then(() => {
                this.$emit('change');
            });
        }
    }
}
</script>

<template>
  <div
    class="border border-1 border-cbp-300 hover:border-cbp-300 px-2 py-1 m-0.5 text-xs font-medium text-center rounded focus:ring-1 focus:outline-none focus:cbp-300 text-white bg-cbp-100"
  >
    <input
      v-model="name"
      type="text"
      class="bg-cbp-100 p-1 text-xs border-0"
      @change="updateTag()"
    >
    <button
      class="border-white border rounded px-1"
      @click="deleteTag()"
    >
      <font-awesome-icon icon="fa-solid fa-times" />
    </button>
  </div>
</template>

<style scoped>

</style>
