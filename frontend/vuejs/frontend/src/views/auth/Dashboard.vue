<script setup lang="ts">
import axiosInstance from '@/lib/axios';
import { ref } from 'vue';

const user = ref({
    name: "",
    email: "",
});
const getUser = async () => {
    try {
        const response = await axiosInstance.get('/user');
        user.value = response.data;
        console.log(response.data);
    }
    catch (error)
    {
console.error(error);
    }
};

const logout = async () => {
    try {
        await axiosInstance.post('/logout');
        user.value = {
            name: "",
            email: "",   
        };
    }
    catch (error)
    {
console.error(error);
    }
};

getUser();
</script>
<template>
<h1 class="text-3xl text-slate-200">Dashboard</h1>
<div class="flex items-center justify-between"></div>
<div>
    <p class="text-lg text-slate-200">welcome back, {{ user?.name }}</p>
    <p class="text-lg text-slate-200">welcome back, {{ user?.email }}</p>
</div>
<button @click="logout" class="btn btn-primary">Logout</button>
</template> 