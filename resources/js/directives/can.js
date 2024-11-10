
// resources/js/directives/can.js

export default {
    beforeMount(el, binding, vnode) {
        console.log(vnode);
        
      const {user, roles, permissions } = vnode.context.$page.props.auth; 
  
      const permissionOrRole = binding.value;
  
      const hasPermission = permissions.includes(permissionOrRole);
      const hasRole = roles.includes(permissionOrRole);
  
      if (!hasPermission && !hasRole) {
        el.style.display = 'none';
      }
    },
  };
  