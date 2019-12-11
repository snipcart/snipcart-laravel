import Vue from 'vue';

export function mutateItem(array, filter, mutation) {
    for(let i=0; i<array.length; i++) {
        const item = array[i];
        if(filter(item)) {
            return Vue.set(array, i, mutation(item));
        }
    }
}

export function mutateItemId(array, id, mutation) {
    mutateItem(array, x => x.id === id, mutation);
}
