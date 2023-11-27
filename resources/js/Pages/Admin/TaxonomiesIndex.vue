<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import {Head} from '@inertiajs/vue3';
import {onMounted, ref} from 'vue';
import axios from 'axios';
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';

const taxonomies = ref([]);
const newTax = ref('');

onMounted(() => {
    refreshData();
});

const refreshData = () => {
    axios
        .get('/admin/taxonomies/list')
        .then((r) => {
            taxonomies.value = r.data;
        });
}

const removeSelf = (id) => {
    axios
        .delete('/admin/taxonomies/' + id)
        .then(() => {
            refreshData();
        });
}

const updateTax = (id, target) => {

    axios.post('/admin/taxonomies/' + id, {
        name: target.value
    }).then(() =>{
        target.classList.toggle('border-green-500');
        setTimeout(()=>{
            target.classList.toggle('border-green-500');
        }, 5000);
    });
}

const addTax = () => {
    console.log(newTax);
    axios.post('/admin/taxonomies', {
        name: newTax.value
    }).then(() => {
        newTax.value = '';
        refreshData();
    })
}

const deleteTag = (id) => {
    axios.delete('/admin/tags/'+id).
    then(() => {
        refreshData();
    })
}
</script>

<template>
  <Head title="Taksonomie" />
  <AdminLayout>
    <div
      v-for="taxonomy in taxonomies"
      :key="taxonomy.id"
    >
      <div>
        <div class="flex justify-between">
          <h3 class="mb-1 font-medium">
            <input
              type="text"
              :value="taxonomy.taxonomy_name"
              @change=" event => updateTax(taxonomy.taxonomy_id, event.target)"
            >
          </h3>
          <button
            class="bg-red-500 text-white rounded px-4 py-1 hover:bg-red-700"
            @click="removeSelf(taxonomy.taxonomy_id)"
          >
            <font-awesome-icon
              class="text-xs cursor-pointer"
              icon="fa-solid fa-xmark"
            />
          </button>
        </div>
        <div class="flex flex-wrap">
          <div
            v-for="tag in taxonomy.tags"
            :key="tag.id"
            class="border border-1 border-cbp-300 hover:border-cbp-300 px-2 py-1 m-0.5 text-xs font-medium text-center rounded focus:ring-1 focus:outline-none focus:cbp-300 text-white bg-cbp-100"
          >
            {{ tag.name }}
            <button
              class="border-white border rounded px-1"
              @click="deleteTag(tag.id)"
            >
              <font-awesome-icon icon="fa-solid fa-times" />
            </button>
          </div>
          <div>
            <h3>Dodaj nowy tag:</h3>
            <input type="text">
            <button>
              Dodaj
            </button>
          </div>
        </div>
      </div>
    </div>
    <div>
      <h3>Dodaj nową taksonomię:</h3>
      <div>
        <input
          v-model="newTax"
          type="text"
          @change="(event) => { newTax = event.target.value}"
        >
        <button
          class="ml-2 p-3 bg-blue-500 rounded text-white"
          @click="addTax"
        >
          <font-awesome-icon
            class=" cursor-pointer"
            icon="fa-solid fa-save"
          />
        </button>
      </div>
    </div>
  </AdminLayout>
</template>
