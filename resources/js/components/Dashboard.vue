<template>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card shadow-sm">
            <div class="card-header">
              <h3>Dashboard
                <router-link to="/person/new" style="float: right;" class="btn btn-success">New person</router-link>
              </h3>
            </div>
            <div class="card-body">
                <table id="personsTable" class="table">
                    <thead class="thead-dark">
                  <tr>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>South African ID Number</th>
                    <th>Mobile Number</th>
                    <th>Email Address</th>
                    <th>Birth Date</th>
                    <th>Language</th>
                    <th>Interests</th>
                    <th>Actions</th>
                
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="person in persons" :key="person.id">
                    <td>{{ person.name }}</td>
                    <td>{{ person.surname }}</td>
                    <td>{{ person.sa_id_number }}</td>
                    <td>{{ person.mobile_number }}</td>
                    <td>{{ person.email }}</td>
                    <td>{{ person.birth_date }}</td>
                    <td>{{ person.language }}</td>
                    <td>
                    <ul>
                      <li v-for="interest in person.interests" :key="interest.text">
                      
                            {{ interest.text }}
                  
                    </li>
                    </ul>
                  </td>
                  <td>
                   <div class="btn-group">
                    <router-link :to="'/person/edit/' + person.id" class="btn btn-primary">Edit</router-link>
                    <button @click="deletePerson(person.id)" class="btn btn-danger">Delete</button>
                   </div>
                  </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>

import $ from 'jquery';
import 'datatables.net';
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css';
import 'datatables.net-bs5/js/dataTables.bootstrap5.min';

  export default {
    name: "Dashboard",
    data() {
      return {
        user: this.$store.state.auth.user,
        persons: [] // Initialize empty array to store persons
      };
    },
    created() {
      // Fetch list of persons when component is created
      this.fetchPersons();
    },
    methods: {
      fetchPersons() {
        // Make API call to fetch list of persons
        // Update the 'persons' array with the response from the API
  
        axios.get('/api/persons')
        .then(response => {
          this.persons = response.data.persons;
          this.$nextTick(() => {
            $('#personsTable').DataTable(); // Initialize DataTable
          });
        })
        .catch(error => {
          console.error('Error fetching persons:', error);
        });
      },
      deletePerson(id) {
        let self = this;
          this.$swal.fire({
            title: 'Remove '+this.persons.find((e) => e.id == id).name+" details?",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Remove',
            denyButtonText: `Cancel`,
            }).then((result) => {
          
            if (result.isConfirmed) {

                self.removePerson(id);
            
            } else if (result.isDenied) {
                

            }
            })
    },

    removePerson(id) {
        let self = this;
        axios.get('/api/persons/delete/'+id)
        .then(response => {
            self.persons = self.persons.filter(person => person.id !== id);
           
            self.$swal.fire('Deleted!', 'Person details have been removed.', 'success');
        })
        .catch(error => {
          console.error('Error fetching persons:', error);
        });
    },
    
    }
  };
  </script>
