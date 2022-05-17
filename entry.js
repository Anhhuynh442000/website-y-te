const path = require('path');

entry = {
    index: path.join(__dirname, 'public/js/src', 'index.js'),
    appointment: path.join(
        __dirname,
        'public/js/src/pages/appointment',
        'index.js'
    ),
    calendar_detail: path.join(
        __dirname,
        'public/js/src/pages/calendar_detail',
        'index.js'
    ),
    calendar_add: path.join(
        __dirname,
        'public/js/src/pages/calendar_add',
        'index.js'
    ),
    medical_file_list: path.join(
        __dirname,
        'public/js/src/pages/medical_file_list',
        'index.js'
    ),
    blog_list: path.join(
        __dirname,
        'public/js/src/pages/blog_list',
        'index.js'
    ),
    medical_file_detail: path.join(
        __dirname,
        'public/js/src/pages/medical_file_detail',
        'index.js'
    ),
    user_list: path.join(
        __dirname,
        'public/js/src/pages/user_list',
        'index.js'
    ),
    master: path.join(__dirname, 'public/js/src/pages/master', 'index.js'),
    medicine_list: path.join(__dirname, 'public/js/src/pages/medicine_list', 'index.js'),
    medicine_type_list: path.join(__dirname, 'public/js/src/pages/medicine_type_list', 'index.js'),
    contact_list: path.join(__dirname, 'public/js/src/pages/contact_list', 'index.js'),
    'user/detail_doctor': path.join(__dirname, 'public/js/src/pages/user/detail_doctor', 'index.js')
};
