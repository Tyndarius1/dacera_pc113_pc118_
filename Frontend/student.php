<style>
  .table-container {
    background: white;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    margin-bottom: 20px;
    width: 100%;
    max-width: 100vw; 
    overflow-x: auto;
}

.table-responsive {
    width: 100%;
    overflow-x: auto;
}

.table {
    width: 100%;
    min-width: 100%;
    table-layout: auto; 
    border-collapse: collapse;
}

.table th,
.table td {
    padding: 10px;
    text-align: center;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.search-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    margin-bottom: 15px;
    width: 100%;
}

.search-container input {
    flex-grow: 1;
    max-width: 300px;
}

.content {
    margin-left: 280px;
    padding: 20px;
    width: calc(100% - 280px); 
    overflow-x: hidden; 
}
</style>

<?php include "sidebar.php" ?>

<div class="content">
    <div class="dashboard-header">
        <h2>Students Overview</h2>
        <h4>Total Students: <span id="total-students">0</span></h4>
    </div>

    <div class="search-container">
        <input type="text" id="search-bar" class="form-control" placeholder="Search students...">
    </div>

    <div class="table-container">
        <h4>Students</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="student-table-body">
                    <tr><td colspan="11" class="text-center">Loading...</td></tr>
                </tbody>
            </table>
            <p id="noResults" style="display: none; text-align: center; color: red; font-weight: bold;">No students found</p>
        </div>
    </div>
</div>




<!-- Modal  -->
<div id="updateModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="update-form">
          <div class="form-group">
            <label for="first-name">First Name</label>
            <input type="text" class="form-control" id="first-name" name="first-name">
          </div>
          <div class="form-group">
            <label for="middle-name">Middle Name</label>
            <input type="text" class="form-control" id="middle-name" name="middle-name">
          </div>
          <div class="form-group">
            <label for="last-name">Last Name</label>
            <input type="text" class="form-control" id="last-name" name="last-name">
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address">
          </div>
          <div class="form-group">
            <label for="contact-number">Contact Number</label>
            <input type="text" class="form-control" id="contact-number" name="contact-number">
          </div>
          <div class="form-group">
            <label for="age">Age</label>
            <input type="text" class="form-control" id="age" name="age">
          </div>
          <div class="form-group">
            <label for="gender">Gender</label>
            <select id="gender" class="form-control">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
          <div class="form-group">
            <label for="status">Status</label>
            <select id="status" class="form-control">
              <option value="Married">Married</option>
              <option value="Single">Single</option>
              <option value="Widowed">Widowed</option>
              <option value="Divorced">Divorced</option>
            </select>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save-changes">Save changes</button>
      </div>
    </div>
  </div>
</div>





<script src="assets/js/student.js"></script>

</body>
</html>
