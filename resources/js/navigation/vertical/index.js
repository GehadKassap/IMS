export default [
  {
    title: 'Dashboard',
    to: { name: 'index' },
    icon: { icon: 'tabler-smart-home' },
    path: '/',
    permission: 'dashboard'
  },
  {
    title: 'System Settings',
    to: { name: '' },
    icon: { icon: 'tabler-settings' },
    children: [
      {
        title: 'Colleges',
        to: 'college-list',
        path: '/colleges',
        permission: 'college list'
      },
      {
        title: 'Departments',
        to: 'departments',
        path: '/departments',
        permission: 'department list'
      },
      {
        title: 'Academic Years',
        to: 'academic-years',
        path: '/academic-years',
        permission: 'academic year list'
      },
      
    ],
  },
  { heading: 'System control' },
  {
    title: 'Users and Roles',
    to: { name: '' },
    icon: { icon: 'tabler-users' },
    children: [
      {
        title: 'Users',
        to: 'user-list',
        path: '/users',
        permission: 'user list'
      },
      {
        title: 'Roles',
        to: 'roles',
        path: '/roles',
        permission: 'role list'
      },
      {
        title: 'Permissions',
        to: 'permissions',
        path: '/under-development',
        permission: 'permission list'
      },
    ],
  },
  
  {
    title: 'System Trash',
    to: 'trash-index',
    icon: { icon: 'tabler-trash' },
    path: '/system-trash',
    permission: 'system trash list'
  },
  {
    title: 'Logs',
    to: { name: 'under-construction' },
    icon: { icon: 'tabler-file' },
    children: [
      {
        title: 'Activity log',
        to: 'activity-log',
        path: '/activity-log',
        permission: 'activity log list'
      },
      {
        title: 'System log',
        to: 'system-log',
        path: '/system-log',
        permission: 'system log list'
      }
    ]
  }
]
