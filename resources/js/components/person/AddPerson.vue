<template>
    <div>
      <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="mb-0">Capture Person</h2>
      <button @click="goBack" class="btn btn-secondary">Back</button>
    </div>
      <form @submit.prevent="capturePerson" novalidate>
        <div class="mb-3">
          <label for="name" class="form-label">Name:</label>
          <input v-model="name" type="text" id="name" class="form-control" required>
          <div v-if="errors.name" class="text-danger">{{ errors.name[0] }}</div>
        </div>
        
        <div class="mb-3">
          <label for="surname" class="form-label">Surname:</label>
          <input v-model="surname" type="text" id="surname" class="form-control" required>
          <div v-if="errors.surname" class="text-danger">{{ errors.surname[0] }}</div>
        </div>
        
        <div class="mb-3">
          <label for="sa_id_number" class="form-label">South African ID Number:</label>
          <input v-model="sa_id_number" type="text" id="sa_id_number" class="form-control" required>
          <div v-if="errors.sa_id_number" class="text-danger">{{ errors.sa_id_number[0] }}</div>
        </div>
        
        <div class="mb-3">
          <label for="mobile_number" class="form-label">Mobile Number:</label>
          <input v-model="mobile_number" type="text" id="mobile_number" class="form-control" required>
          <div v-if="errors.mobile_number" class="text-danger">{{ errors.mobile_number[0] }}</div>
        </div>
        
        <div class="mb-3">
          <label for="email" class="form-label">Email Address:</label>
          <input v-model="email" type="email" id="email" class="form-control" required>
          <div v-if="errors.email" class="text-danger">{{ errors.email[0] }}</div>
        </div>
        
        <div class="mb-3">
          <label for="birth_date" class="form-label">Birth Date:</label>
          <input v-model="birth_date" type="date" id="birth_date" class="form-control" required>
          <div v-if="errors.birth_date" class="text-danger">{{ errors.birth_date[0] }}</div>
        </div>
        
        <div class="mb-3">
        <label for="language" class="form-label">Language:</label>
        <select v-model="language" id="language" class="form-select" required>
          <option v-for="language in languages" :value="language.name">{{ language.name }}</option>
        </select>
        <div v-if="errors.language" class="text-danger">{{ errors.language[0] }}</div>
      </div>
        
      <div class="mb-3">
        <label for="interests" class="form-label">Interests:</label>
        <vue-tags-input 
        v-model="interest" 
        :tags="interests" 
        placeholder="Add interests" 
        label="name" 
       
        @tags-changed="newTags => interests = newTags"
        ></vue-tags-input>
       
        <div v-if="errors.interests" class="text-danger">{{ errors.interests[0] }}</div>
      </div>
        
        <button type="submit" :disabled="isSubmitting"  class="btn btn-primary">Capture</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import VueTagsInput from "@sipec/vue3-tags-input";

  export default {
    components: {
    VueTagsInput
  },
  created(){
    this.fetchLanguages();
  },
    data() {
      return {
        isSubmitting: false,
          name: '',
          surname: '',
          sa_id_number: '',
          mobile_number: '',
          email: '',
          birth_date: '',
          languages: [],
          language: '',
          interest: '',
       
        interests: [
         
        ],
        errors: {}
      }
    },
    methods: {
      goBack() {
        this.$router.go(-1); // Go back one step in history
      },
        fetchLanguages() {
          let self = this;
      axios.get('https://restcountries.com/v3.1/all?fields=languages')
        .then(response => {
          let languagesObject = response.data.reduce((acc, cur) => {
        Object.keys(cur.languages).forEach(langCode => {
          acc[langCode] = { name: cur.languages[langCode] }; // Remove duplicates
        });
        return acc;
      }, {});

      self.languages = Object.values(languagesObject);

      console.log(self.languages);
        })
        .catch(error => {
          console.error(error);
        });
    },
      capturePerson() {

        let self = this;
        this.isSubmitting = true;
        axios.post('/api/persons/store', {
          name: this.name,
          surname: this.surname,
          sa_id_number: this.sa_id_number,
          mobile_number: this.mobile_number,
          email: this.email,
          birth_date: this.birth_date,
          language: this.language,
          interests: this.interests,
        })
          .then(response => {
            // Handle success
            console.log(response.data);
            
            self.isSubmitting = true;
            self.$swal.fire({
							title: 'Succesfully stored information and sent confirmation to the user',
							showDenyButton: true,
							showCancelButton: false,
							confirmButtonText: 'New Person',
							denyButtonText: `View All Saved`,
							}).then((result) => {
							/* Read more about isConfirmed, isDenied below */
							if (result.isConfirmed) {
							
							} else if (result.isDenied) {
								

              window.location.href = "/";
							}
							})
          
            this.errors = {}; // Clear errors
          })
          .catch(error => {
            // Handle error
            if (error.response.status === 422) {
              this.errors = error.response.data.errors;
            } else {
              console.error(error);
            }
          });
      }
    }
  }
  </script>
  
  <style scoped>
  /* Add your component-specific styles here */
  </style>
  