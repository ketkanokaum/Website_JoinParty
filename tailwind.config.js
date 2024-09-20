const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // เพิ่มสีที่ใช้ตามภาพ
                'primary': '#ffbf69',  // สีปุ่ม
                'background-start': '#fdf2f8', // ไล่สีพื้นหลัง เริ่มจากสีอ่อน
                'background-end': '#ede9fe',   // ไล่สีพื้นหลังไปสีม่วงอ่อน
                'button-text': '#000000', // สีตัวอักษรปุ่ม
                'form-text': '#6b7280', // สีข้อความในฟอร์ม (Placeholder)
            },
            backgroundImage: theme => ({
                'gradient-bg': 'linear-gradient(to right, #fdf2f8, #ede9fe)', // ไล่เฉดสีพื้นหลัง
            }),
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
