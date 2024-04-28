<script>
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
import axios from 'axios';

export default {
    name: 'AddTag',
    components: {FontAwesomeIcon},
    props: {
        taxonomy: {
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
    methods: {
        addTag() {
            axios.post('/admin/tags', {
                name: this.name,
                taxonomy_id: this.taxonomy.taxonomy_id,
            }).then(() => {
                this.$emit('change');
                this.name = '';
            })
        }
    }
}
</script>

<template>
  <div>
    <h3>Dodaj nowy tag:</h3>
    <input
      v-model="name"
      type="text"
      class="text-xs"
    >
    <button
      class="ml-2 bg-zhp-700 text-white rounded px-3 py-1"
      @click="addTag()"
    >
      <font-awesome-icon icon="fa-solid fa-plus" />
      Dodaj
    </button>
  </div>
</template>

<style scoped>

</style>
