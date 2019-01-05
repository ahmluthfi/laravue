<template>
	<div class="container">
		<h2>
			Users Listings
		</h2>


		<a href="/users/create" class="btn btn-md btn-success">
			+ Add User
		</a>

		<table class="table table-bordered">
			<thead>
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Image</th>
				<th>Action</th>
			</thead>
			<tbody>
				<tr v-for="user in users">
					<td>{{ user.id }}</td>
					<td>{{ user.name }}</td>
					<td>{{ user.email }}</td>
					<td>

					</td>
					<td>
						<a class="btn btn-sm btn-primary" v-on:click="editUser(user.id)">
							Edit 
						</a>

						<a class="btn btn-sm btn-danger" v-on:click="deleteUser(user.id)">
							Delete
						</a>
					</td>
				</tr>
			</tbody>
		</table>

		<div class="pagination">
			<a class="btn btn-default" v-on:click="fetchPaginateUsers(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">
				Previous
			</a>

			<span>
			Page {{pagination.current_page}} of {{pagination.last_page}}
			</span>

			<a class="btn btn-default" v-on:click="fetchPaginateUsers(pagination.next_page_url)" :disabled="!pagination.next_page_url">
				Next
			</a>
		</div>

	</div>

</template>


<script>
	export default {
		data(){
			return {
				users : [],
				user : {
					id : 0,
					name : '',
					email : '',
				},
				url: '/api/users',
				pagination: [],
			}
		},
		mounted(){
			this.getUsers();
		}, 
		methods: {
			getUsers() {
				let $this = this;
				axios.get(this.url).then(response => {
					this.users = response.data.data;
					$this.makePagination(response.data);
				});
			},
			editUser(id){
				window.location.href = '/users/'+id+'/edit';
			},
			deleteUser(id){
				axios.delete('/api/users/'+id).then(response => {
					this.getUsers();
				});
			},
			makePagination(data){
				let pagination = {
					current_page : data.current_page,
					last_page : data.last_page,
					next_page_url : data.next_page_url,
					prev_page_url : data.prev_page_url,
				}

				this.pagination = pagination;
			},
			fetchPaginateUsers(url){
				this.url = url;
				this.getUsers();
			},
		}
	}
</script>

<style>
</style>