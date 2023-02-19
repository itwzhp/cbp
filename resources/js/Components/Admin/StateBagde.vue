<template>
  <div
    class="p-3 rounded text-sm text-center"
    :class="stateClass"
  >
    {{ stateText }}
  </div>
</template>

<script>

export default {
    name: 'StateBagde',
    props: {
        'state': {
            required: true,
            type: String
        }
    },
    computed: {
        stateClass() {
            switch (this.state) {
                case 'published':
                    return 'bg-green-200';
                case 'archived':
                    return 'bg-gray-200';
                case 'draft':
                    return 'bg-blue-200';
                case 'review':
                    return 'bg-purple-200';
                case 'changes':
                    return 'bg-orange-200';
                case 'pending':
                    return 'bg-yellow-200';
                case 'rejected':
                    return 'bg-red-200';
            }

            return '';
        },
        stateText() {
            switch (this.state) {
                case 'published':
                    return 'Opublikowany';
                case 'archived':
                    return 'Archiwalny';
                case 'draft':
                    return 'Szkic';
                case 'review' :
                    return 'Recenzowany';
                case 'changes' :
                    return 'Wymagane zmiany';
                case 'pending' :
                    return 'Oczekuje';
                case 'rejected' :
                    return 'Odrzucony';
            }

            return '';
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
