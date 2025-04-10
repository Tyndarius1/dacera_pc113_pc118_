document.addEventListener("DOMContentLoaded", function () {
    fetchStudents();
    document.getElementById("search-bar").addEventListener("keyup", filterStudents);
});

function fetchStudents() {
    fetch(`http://127.0.0.1:8000/api/users?role=student`, {
        headers: { Authorization: `Bearer ${localStorage.getItem("token")}` },
    })
    .then(response => {
        if (!response.ok) throw new Error(`Failed to load students`);
        return response.json();
    })
    .then(users => {
        const tableBody = document.getElementById("student-table-body");
        tableBody.innerHTML = ""; 

        if (users.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="11" class="text-center">No students found.</td></tr>`;
            document.getElementById("total-students").textContent = "0";
            return;
        }

        document.getElementById("total-students").textContent = users.length;

        users.forEach(user => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${user.id}</td>
                <td>${user.first_name}</td>
                <td>${user.middle_name || '-'}</td>
                <td>${user.last_name}</td>
                <td>${user.address}</td>
                <td>${user.contact_number}</td>
                <td>${user.age}</td>
                <td>${user.gender}</td>
                <td>${user.status}</td>
                <td>${user.email}</td>
                <td>
                    <button class="btn btn-sm btn-primary" onclick="openUpdateModal(${user.id})">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteStudent(${user.id})">Delete</button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    })
    .catch(error => {
        console.error(error);
        document.getElementById("student-table-body").innerHTML = `<tr><td colspan="11" class="text-danger text-center">Failed to load students.</td></tr>`;
    });
}

function filterStudents() {
    const searchValue = document.getElementById("search-bar").value.toLowerCase();
    const rows = document.querySelectorAll("#student-table-body tr");
    let found = false;

    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if (text.includes(searchValue)) {
            row.style.display = "";
            found = true;
        } else {
            row.style.display = "none";
        }
    });

   
    document.getElementById("noResults").style.display = found ? "none" : "block";
}





// Open Modal


function openUpdateModal(id) {

    fetch(`http://127.0.0.1:8000/api/user/${id}`, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${localStorage.getItem("token")}`
        }
    })
    .then(response => {
        if (!response.ok) throw new Error('Failed to fetch student details.');
        return response.json();
    })
    .then(student => {
      
        document.getElementById("first-name").value = student.first_name;
        document.getElementById("middle-name").value = student.middle_name || '';
        document.getElementById("last-name").value = student.last_name;
        document.getElementById("address").value = student.address;
        document.getElementById("contact-number").value = student.contact_number;
        document.getElementById("age").value = student.age;
        document.getElementById("gender").value = student.gender;
        document.getElementById("status").value = student.status;
        document.getElementById("email").value = student.email;

    
        document.getElementById("save-changes").setAttribute('data-id', student.id);

       
        $('#updateModal').modal('show');
    })
    .catch(error => {
        console.error(error);
        alert('Failed to load student details.');
    });
}




// Update Student Using API


document.getElementById("save-changes").addEventListener("click", function() {
    const id = this.getAttribute('data-id');
    const updatedStudent = {
        first_name: document.getElementById("first-name").value,
        middle_name: document.getElementById("middle-name").value,
        last_name: document.getElementById("last-name").value,
        address: document.getElementById("address").value,
        contact_number: document.getElementById("contact-number").value,
        age: document.getElementById("age").value,
        gender: document.getElementById("gender").value,
        status: document.getElementById("status").value,
        email: document.getElementById("email").value
    };

  
    fetch(`http://127.0.0.1:8000/api/update/${id}`, {
        method: 'PUT',
        headers: {
            'Authorization': `Bearer ${localStorage.getItem("token")}`,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(updatedStudent)
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        fetchStudents(); 
        $('#updateModal').modal('hide'); 
    })
    .catch(error => {
        console.error(error);
        alert("Failed to update student");
    });
});








// Delete Student Using API

function deleteStudent(id) {
    const confirmDelete = confirm("Are you sure you want to delete this student?");
    if (!confirmDelete) return;

    fetch(`http://127.0.0.1:8000/api/profile/${id}`, {
        method: 'DELETE',
        headers: {
            'Authorization': `Bearer ${localStorage.getItem("token")}`
        },
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        fetchStudents();
    })
    .catch(error => {
        console.error(error);
        alert("Failed to delete student");
    });
}