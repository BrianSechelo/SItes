<script setup lang="ts">
  import { onMounted } from "vue";
  import axiosInstance from "@/lib/axios";
  import { reactive, ref } from "vue";
  import { computed } from "vue";
  
  interface ClothingItem {
    name: string;
    category: string;
    color: string;
  }
  
  const form = reactive<ClothingItem>({
    name: "",
    category: "",
    color: "#ffffff",
  });

  const fetchClothes = async () => {
  try {
    const response = await axiosInstance.get("/clothes");
    items.value = response.data;
  } catch (error) {
    console.error("Error fetching clothes:", error);
  }
};
  
onMounted(() => {
  fetchClothes();
});
const items = ref<ClothingItem[]>([]);
  const editing = ref(false);
  const editIndex = ref<number | null>(null);

  const selectedCategory = ref("");
  const searchQuery = ref("");
  
  const filteredItems = computed(() => {
  return items.value.filter(item => {
    const matchesCategory = selectedCategory.value === "" || item.category === selectedCategory.value;
    const matchesSearch = item.name.toLowerCase().includes(searchQuery.value.toLowerCase());
    return matchesCategory && matchesSearch;
  });
});

  const handleSubmit = async () => {
  const payload = { ...form };

  try {
    if (editing.value && editIndex.value !== null) {
      const id = items.value[editIndex.value].id;
      await axiosInstance.put(`/clothes/${id}`, payload);
      items.value[editIndex.value] = { ...form, id };
    } else {
      const response = await axiosInstance.post("/clothes", payload);
      items.value.push(response.data);
    }
    resetForm();
    editing.value = false;
    editIndex.value = null;
  } catch (error) {
    console.error("Error saving clothing item:", error);
  }
};

  function editItem(item: ClothingItem, index: number) {
    Object.assign(form, item);
    editing.value = true;
    editIndex.value = index;
  }

  const deleteItem = async (index: number) => {
  const id = items.value[index].id;
  try {
    if (confirm("Are you sure you want to delete this item?")) {
    await axiosInstance.delete(`/clothes/${id}`);
    items.value.splice(index, 1);
  } }
  catch (error) {
    console.error("Error deleting clothing item:", error);
  }
};
  
  function cancelEdit() {
    editing.value = false;
    editIndex.value = null;
    resetForm();
  }
  
  function resetForm() {
    form.name = "";
    form.category = "";
    form.color = "#ffffff";
  }
  </script>
  <template>
    <div class="flex flex-col sm:flex-row gap-4 mb-6">
  <select v-model="selectedCategory" class="p-2 border rounded w-full sm:w-1/3">
    <option value="">All Categories</option>
    <option>Tops</option>
    <option>Bottoms</option>
    <option>Accessories</option>
    <option>Shoes</option>
  </select>

  <input
    type="text"
    v-model="searchQuery"
    placeholder="Search by name..."
    class="p-2 border rounded w-full sm:w-2/3"
  />
</div>
    <div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow">
      <h2 class="text-2xl font-bold mb-6">Manage Wardrobe</h2>
  
      <!-- Add/Edit Clothing Form -->
      <form @submit.prevent="handleSubmit" class="space-y-4">
        <input
          type="text"
          v-model="form.name"
          placeholder="Clothing name"
          class="w-full p-2 border rounded"
          required
        />
  
        <select v-model="form.category" class="w-full p-2 border rounded">
          <option disabled value="">Select Category</option>
          <option>Tops</option>
          <option>Bottoms</option>
          <option>Accessories</option>
          <option>Shoes</option>
        </select>
  
        <input
          type="color"
          v-model="form.color"
          class="w-full p-2 border rounded"
        />
  
        <div class="flex gap-4">
          <button
            type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
          >
            {{ editing ? "Update Item" : "Add Item" }}
          </button>
          <button
            v-if="editing"
            @click="cancelEdit"
            type="button"
            class="bg-gray-400 text-white px-4 py-2 rounded"
          >
            Cancel
          </button>
        </div>
      </form>
  
      <!-- Clothing List -->
      <div class="mt-10">
        <h3 class="text-xl font-semibold mb-4">Wardrobe Items</h3>
        <ul>
          <li 
          v-for="(item, index) in filteredItems"

            :key="index"
            class="border-b py-2 flex justify-between items-center"
          >
            <span>{{ item.name }} ({{ item.category }})</span><span class="ml-2 inline-block w-4 h-4 rounded" :style="{ backgroundColor: item.color }"></span>

            <div class="space-x-2">
              <button @click="editItem(item, index)" class="text-blue-600">Edit</button>
              <button @click="deleteItem(index)" class="text-red-600">Delete</button>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </template>