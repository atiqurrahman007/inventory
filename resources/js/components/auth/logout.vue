<template>
	<div>
		
	</div>
</template>
<script type="text/javascript">
	export default{
		name:"logout",
		created(){
			User.logOut();
			this.$router.push('/')
		}
	}
</script>