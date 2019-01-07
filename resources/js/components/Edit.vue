<template>
	<div class="container">
		<h2>
			Edit User
		</h2>
		    <form class="form-horizontal" v-on:submit.prevent="editUser()">

              <div class="form-group">
                <input type="text" class="form-control" placeholder="Name" name="name" v-model="name">
                <label for="inputPassword">Nama</label>
              </div>

              <div class="form-group">
                <input type="email" name="email" v-model="email" id="inputEmail" class="form-control" placeholder="Email address">
                <label for="inputEmail">Email address</label>
              </div>

              <div class="form-group">
                <input type="file" class="form-control" name="file" @change="imageChanged">
                <label for="inputPassword">Foto</label>
              </div>

              <button class="btn btn-lg btn-primary " type="submit">Update</button>
              
            </form>

	</div>

</template>


<script>
	export default {
		props: ['id'],
		data(){
			return {
				name : '',
				email : '',
				password : '',
				csrf_token : $('meta[name="csrf-token"]').attr('content'),
				image : ''
			}
		},
		mounted(){
			this.getUser();
		}, 
		methods: {
			getUser() {
				axios.get('/api/users/'+this.id).then(response => {
					var user = response.data;
					this.name = user.name;
					this.email = user.email;
				}).catch(error => {
					console.log(this.error);
				});
			},
			editUser() {
				axios.put('/api/users/'+this.id,{
					name: this.name,
					email: this.email,
					csrf_token:   this.csrf_token,
					image: this.image,
				} ).then(response => {
					window.location.href = '/users';
				}).catch(error => {
					console.log(this.error);
				});
			},

			imageChanged(e){
				var fileReader = new FileReader();

				fileReader.readAsDataURL(e.target.files[0])

				fileReader.onload = (e) => {
					this.image = e.target.result
				}
				
			}
		}
	}
</script>

<style>
</style>