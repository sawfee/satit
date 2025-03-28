const courseApiUrl = 'https://api-eduservice.yru.ac.th/api-fee/satit/time/course.php'; // URL API สำหรับจังหวัด
const staffApiUrl = 'https://api-eduservice.yru.ac.th/api-fee/satit/time/course.php'; 

function loadCourse(provinceId) {
    fetch(`${courseApiUrl}?id=${provinceId}`)
    .then(response => response.json())
    .then(data => {
      const courseSelect = document.getElementById('single1-select');
      courseSelect.innerHTML = '<option value="" selected disabled>เลือกผู้สอน</option>';
      data.forEach(course => {
        const option = document.createElement('option');
        option.value = course.COURSEID; // ใช้ id เป็นค่า value
        option.textContent = course.COURSENAME; // ใช้ name เป็นข้อความ
        courseSelect.appendChild(option);
      });
    })
    .catch(error => {
      console.error('Error fetching courses:', error);
      const courseSelect = document.getElementById('single1-select');
      courseSelect.innerHTML = '<option value="" selected>ไม่สามารถโหลดอำเภอได้</option>';
    });
  }
  
  
function loadStaff() {
    alert('ddddddd')
    fetch(staffApiUrl)
    .then(response => response.json())
    .then(data => {
      const staffSelect = document.getElementById('single-select');
      staffSelect.innerHTML = '<option value="" selected disabled>เลือกผู้สอน</option>';
      data.forEach(course => {
        const option = document.createElement('option');
        option.value = course.COURSEID; // ใช้ id เป็นค่า value
        option.textContent = course.COURSENAME; // ใช้ name เป็นข้อความ
        staffSelect.appendChild(option);
      });
    })
    .catch(error => {
      console.error('Error fetching courses:', error);
      const staffSelect = document.getElementById('course');
      staffSelect.innerHTML = '<option value="" selected>ไม่สามารถโหลดอำเภอได้</option>';
    });
  }
  
//   window.onload = function() {
//     loadStaff(); // โหลดจังหวัดเมื่อหน้าเว็บโหลด

//   };

document.getElementById('class').addEventListener('change', function () {
    const classId = this.value;
    if (classId) {
        loadCourse(classId); // โหลดอำเภอเมื่อเลือกจังหวัด
    }
});

document.getElementById('single-select').addEventListener('change', function () {
    const staffId = this.value;
    if (staffId) {
        console.log(`Selected Staff ID: ${staffId}`);
        // Perform additional actions if needed
    }
});