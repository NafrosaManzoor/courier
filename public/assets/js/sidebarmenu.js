var app = angular.module('studentApp', ['ngRoute']);
var baseUrl = 'http://127.0.0.1:8000';

// ---------------- Page Load

app.controller('MainController', function ($scope, $http) {
    // Default content URL (dashboard)
    $scope.pageName = 'Dashboard';
    $scope.contentUrl = '/dashboard';

    // Function to load content dynamically
    $scope.loadContent = function (page) {
        $scope.contentUrl = '/' + page; // Adjust the URL to point to Laravel routes
        $scope.pageName = page;
    };
});

// Define the service for fetching classes
app.service('Service', function ($http) {

    this.getSubjects = function () {
        // Return the API call to get the list of classes
        return $http.get(baseUrl + '/subject');
    };

    this.getSchools = function () {
        // Return the API call to get the list of classes
        return $http.get(baseUrl + '/school_details');
    };

    this.getStudents = function () {
        // Return the API call to get the list of classes
        return $http.get(baseUrl + '/student_details');
    };

    this.getClasses = function () {
        // Return the API call to get the list of classes
        return $http.get(baseUrl + '/class');
    };

    this.getMarks = function () {
        // Return the API call to get the list of classes
        return $http.get(baseUrl + '/term_marks');
    };




});


// ---------------- School ------------

// var app = angular.module('schoolApp', []);
app.controller('SchoolController', function ($scope, $http, Service) {
    $scope.schoolData = {};
    $scope.schools = [];

    // Observe button value for submit/update
    $scope.btnObserve = function () {
        $scope.btnValue = $scope.schoolData.id ? 'Update' : 'Submit';
    };

    $scope.btnObserve();

    // Reset form
    $scope.resetForm = function () {
        $scope.schoolData = {};
        $scope.btnObserve();
        $scope.schoolForm.$setPristine();
        $scope.schoolForm.$setUntouched();
    };

    // Refresh school list
    $scope.refreshTable = function () {
        Service.getSchools().then(function (response) {
            $scope.schools = response.data['data']; // Adjust according to your API response
            console.log("School data fetched:", response.data['data']);
        }, function (error) {
            console.log('Error fetching schools:', error);
        });
    };

    // Call refresh function on controller initialization
    $scope.refreshTable();

    // Submit form via POST or PUT
    $scope.submitSchool = function () {
        if ($scope.schoolForm.$valid) {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            var method = $scope.schoolData.id ? 'PUT' : 'POST';
            var url = $scope.schoolData.id ? baseUrl + '/school_details/' + $scope.schoolData.id : baseUrl + '/school_details';

            $http({
                method: method,
                url: url,
                data: $scope.schoolData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            }).then(function (response) {
                alert(response.data.message);
                $scope.resetForm();
                $scope.refreshTable(); // Refresh the list of schools after add/update

            }).catch(function (error) {
                console.log('Error submitting form:', error);
            });
        }
    };

    // Load school data for editing
    $scope.loadSchoolData = function (id) {
        $http({
            method: 'GET',
            url: baseUrl + '/school_details/' + id
        }).then(function (response) {
            $scope.schoolData = response.data['data']; // Load the school data into the form
            $scope.btnObserve(); // Update the button value to "Update"
        }).catch(function (error) {
            alert('Error loading school data');
            console.log(error);
        });
    };

    // Delete a school
    $scope.deleteSchool = function (id) {
        if (confirm('Are you sure you want to delete this school?')) {
            $http({
                method: 'DELETE',
                url: baseUrl + '/school_details/' + id
            }).then(function (response) {
                alert(response.data.message);
                $scope.refreshTable(); // Refresh school list after deletion

            }).catch(function (error) {
                alert('An error occurred while deleting the school');
                console.log(error);
            });
        }
    };
});


//----------------- Student -------------------

app.controller('StudentController', function ($scope, $http, Service) {
    $scope.studentData = {};
    $scope.students = [];

    // Observe button value for submit/update
    $scope.btnObserve = function () {
        $scope.btnValue = $scope.studentData.id ? 'Update' : 'Submit';
    };

    $scope.btnObserve();

    // Reset form
    $scope.resetForm = function () {
        $scope.studentData = {};
        $scope.btnObserve();
        $scope.studentForm.$setPristine();
        $scope.studentForm.$setUntouched();
    };

    // Refresh student list
    $scope.refreshTable = function () {
        Service.getStudents().then(function (response) {
            $scope.students = response.data['data']; // Adjust according to your API response
            console.log("Student data fetched:", response.data['data']);
        }, function (error) {
            console.log('Error fetching students:', error);
        });
    };

    // Call refresh function on controller initialization
    $scope.refreshTable();

    // Submit form via POST or PUT
    $scope.submitStudent = function () {
        if ($scope.studentForm.$valid) {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            var method = $scope.studentData.id ? 'PUT' : 'POST';
            var url = $scope.studentData.id ? baseUrl + '/student_details/' + $scope.studentData.id : baseUrl + '/student_details';

            $http({
                method: method,
                url: url,
                data: $scope.studentData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            }).then(function (response) {
                alert(response.data.message);
                $scope.resetForm();
                $scope.refreshTable(); // Refresh the list of students after add/update

            }).catch(function (error) {
                console.log('Error submitting form:', error);
            });
        }
    };

    // Load student data for editing
    $scope.loadStudentData = function (id) {
        $http({
            method: 'GET',
            url: baseUrl + '/student_details/' + id
        }).then(function (response) {
            $scope.studentData = response.data['data']; // Load the student data into the form
            $scope.btnObserve(); // Update the button value to "Update"
        }).catch(function (error) {
            alert('Error loading student data');
            console.log(error);
        });
    };

    // Delete a student
    $scope.deleteStudent = function (id) {
        if (confirm('Are you sure you want to delete this student?')) {
            $http({
                method: 'DELETE',
                url: baseUrl + '/student_details/' + id
            }).then(function (response) {
                alert(response.data.message);
                $scope.refreshTable(); // Refresh student list after deletion

            }).catch(function (error) {
                alert('An error occurred while deleting the student');
                console.log(error);
            });
        }
    };
});



//----------------- Class -------------------

app.controller('classController', function ($scope, $http, Service) {

    $scope.classData = {};
    $scope.classes = [];


    $scope.btnObserve = function () {
        $scope.btnValue = $scope.classData.id ? 'Update' : 'Submit';
    }

    $scope.btnObserve();

    $scope.resetForm = function () {
        $scope.classData = {};
        $scope.btnObserve();
        $scope.classForm.$setPristine();
        $scope.classForm.$setUntouched();
    }

    // Function to fetch all classes and refresh the table
    $scope.refreshTable = function () {
        Service.getClasses().then(function (response) {
            // Assuming the API returns the data directly without an additional 'data' key
            $scope.classes = response.data['data']; // Adjust according to the actual API response
            // console.log(response.data['data']);
        }, function (error) {
            console.log("Error fetching classes: ", error);
        });
    };

    // Call the refresh function on controller initialization
    $scope.refreshTable();

    // Function to submit (either create or update)
    $scope.submitClass = function () {
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // If there's an id, update; otherwise, create a new class
        var method = $scope.classData.id ? 'PUT' : 'POST';
        var url = $scope.classData.id ? '/class/' + $scope.classData.id : '/class';

        $http({
            method: method,
            url: url,
            data: $scope.classData,
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            }
        }).then(function (response) {
            alert(response.data.message);
            $scope.classData = {}; // Reset form
            $scope.classForm.$setPristine();
            $scope.classForm.$setUntouched();
            $scope.btnObserve();
            // Refresh the classes list after adding/updating
            $scope.refreshTable();

        }).catch(function (error) {
            alert('An error occurred in class');
            console.log(error);
        });
    };

    // Function to load class data for editing
    $scope.loadClassData = function (id) {
        $http({
            method: 'GET',
            url: baseUrl + '/class/' + id
        }).then(function (response) {
            $scope.classData = response.data['data']; // Load the class data into the form
            $scope.btnObserve();
        }).catch(function (error) {
            alert('An error occurred while loading the class data');
            console.log(error);
        });
    };

    // Function to delete a class
    $scope.deleteClass = function (id) {
        if (confirm('Are you sure you want to delete this class?')) {
            $http({
                method: 'DELETE',
                url: baseUrl + '/class/' + id
            }).then(function (response) {
                alert(response.data.message);

                // Refresh the classes list after deleting
                $scope.refreshTable();

            }).catch(function (error) {
                alert('An error occurred while deleting the class');
                console.log(error);
            });
        }
    };


});

//----------------- Subject -------------------

app.controller('SubjectController', function ($scope, $http, Service) {

    $scope.subjectData = {};
    $scope.subjects = [];


    $scope.btnObserve = function () {
        $scope.btnValue = $scope.subjectData.id ? 'Update' : 'Submit';
    }

    $scope.btnObserve();

    $scope.resetForm = function () {
        $scope.subjectData = {};
        $scope.btnObserve();
        $scope.subjectForm.$setPristine();
        $scope.subjectForm.$setUntouched();
    }

    // Function to fetch all subjects and refresh the table
    $scope.refreshTable = function () {
        Service.getSubjects().then(function (response) {
            // Assuming the API returns the data directly without an additional 'data' key
            $scope.subjects = response.data['data']; // Adjust according to the actual API response
            console.log(response.data['data']);
        }, function (error) {
            console.log("Error fetching subjects: ", error);
        });
    };

    // Call the refresh function on controller initialization
    $scope.refreshTable();

    // Function to submit (either create or update)
    $scope.submitSubject = function () {
        if ($scope.subjectForm.$valid) {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // If there's an id, update; otherwise, create a new class
            var method = $scope.subjectData.id ? 'PUT' : 'POST';
            var url = $scope.subjectData.id ? '/subject/' + $scope.subjectData.id : '/subject';

            $http({
                method: method,
                url: url,
                data: $scope.subjectData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            }).then(function (response) {
                alert(response.data.message);
                $scope.subjectData = {}; // Reset form
                $scope.subjectForm.$setPristine();
                $scope.subjectForm.$setUntouched();
                $scope.btnObserve();
                // Refresh the subjects list after adding/updating
                $scope.refreshTable();

            }).catch(function (error) {
                alert('An error occurred in Subject');
                console.log(error);
            });
        }
    };

    // Function to load class data for editing
    $scope.loadSubjectData = function (id) {
        $http({
            method: 'GET',
            url: baseUrl + '/subject/' + id
        }).then(function (response) {
            $scope.subjectData = response.data['data']; // Load the class data into the form
            $scope.btnObserve();
        }).catch(function (error) {
            alert('An error occurred while loading the subject data');
            console.log(error);
        });
    };

    // Function to delete a class
    $scope.deleteSubject = function (id) {
        if (confirm('Are you sure you want to delete this subject?')) {
            $http({
                method: 'DELETE',
                url: baseUrl + '/subject/' + id
            }).then(function (response) {
                alert(response.data.message);

                // Refresh the subjects list after deleting
                $scope.refreshTable();

            }).catch(function (error) {
                alert('An error occurred while deleting the subject');
                console.log(error);
            });
        }
    };


});

//----------------- Term marks -------------------

app.controller('marksController', function ($scope, $http, Service) {
    $scope.marksData = {};
    $scope.marks = [];
    $scope.terms = ['Term 1', 'Term 2', 'Term 3'];
    $scope.Statuses = ['Pass', 'Fail'];



    // Observe button value for submit/update
    $scope.btnObserve = function () {
        $scope.btnValue = $scope.marksData.id ? 'Update' : 'Submit';
    };

    $scope.btnObserve();

    // Reset form
    $scope.resetForm = function () {
        $scope.marksData = {};
        $scope.btnObserve();
        $scope.marksForm.$setPristine();
        $scope.marksForm.$setUntouched();
    };

    // Refresh marks list
    $scope.refreshTable = function () {
        Service.getMarks().then(function (response) {
            $scope.marks = response.data['data']; // Adjust according to your API response
            console.log("Marks data fetched:", response.data['data']);
        }, function (error) {
            console.log('Error fetching marks:', error);
        });
    };

    // Call refresh function on controller initialization
    $scope.refreshTable();

    // Submit form via POST or PUT
    $scope.submitMarks = function () {
        // if ($scope.marksForm.$valid) {
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        console.log($scope.marksData);
        var method = $scope.marksData.id ? 'PUT' : 'POST';
        var url = $scope.marksData.id ? baseUrl + '/term_marks/' + $scope.marksData.id : baseUrl + '/term_marks';

        $http({
            method: method,
            url: url,
            data: $scope.marksData,
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            }
        }).then(function (response) {
            alert(response.data.message);
            $scope.resetForm();
            $scope.refreshTable(); // Refresh the list of marks after add/update

        }).catch(function (error) {
            console.log('Error submitting form:', error);
        });
        // }
    };

    // Load marks data for editing
    $scope.loadMarksData = function (id) {
        $http({
            method: 'GET',
            url: baseUrl + '/term_marks/' + id
        }).then(function (response) {
            $scope.marksData = response.data['data']; // Load the marks data into the form
            $scope.btnObserve(); // Update the button value to "Update"
        }).catch(function (error) {
            alert('Error loading marks data');
            console.log(error);
        });
    };

    // Delete marks
    $scope.deleteMarks = function (id) {
        if (confirm('Are you sure you want to delete these marks?')) {
            $http({
                method: 'DELETE',
                url: baseUrl + '/term_marks/' + id
            }).then(function (response) {
                alert(response.data.message);
                $scope.refreshTable(); // Refresh marks list after deletion

            }).catch(function (error) {
                alert('An error occurred while deleting the marks');
                console.log(error);
            });
        }
    };
});
