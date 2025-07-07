<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Profile Generator</title>
    <style>
        /* General body styling */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Microsoft-inspired font */
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #eaf2f8, #d1e8f9); /* Gradient background */
            color: #333; /* Dark text for better contrast */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Container styling */
        .container {
            max-width: 700px;
            width: 90%;
            background: #fff; /* White background for the form */
            padding: 40px;
            border-radius: 16px; /* Softly rounded corners */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); /* Smooth shadow */
            animation: fadeIn 1.2s ease-in-out; /* Fade-in animation */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Header styling */
        h1 {
            font-size: 28px;
            font-weight: 700;
            color: #2b579a; /* Microsoft blue */
            text-align: center;
            margin-bottom: 30px;
            animation: slideIn 1s ease-in-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Floating form labels and inputs */
        .form-group {
            position: relative;
            margin-bottom: 30px;
        }

        input, textarea {
            width: 100%;
            padding: 15px;
            font-size: 16px;
            border: 2px solid transparent;
            border-radius: 8px; /* Rounded edges */
            background: #f7f9fc; /* Light gray background */
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle inner shadow */
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input:focus, textarea:focus {
            border-color: #2b579a; /* Microsoft blue */
            box-shadow: 0 0 8px rgba(43, 87, 154, 0.3); /* Blue glow on focus */
            outline: none;
        }

        textarea {
            resize: none; /* Prevent resizing for cleaner design */
        }

        /* Floating labels */
        label {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            font-size: 16px;
            color: #999; /* Subtle label color */
            pointer-events: none;
            transition: all 0.3s ease;
            background: white;
            padding: 0 5px;
        }

        input:focus + label, textarea:focus + label,
        input:not(:placeholder-shown) + label, textarea:not(:placeholder-shown) + label {
            top: -8px;
            left: 12px;
            font-size: 12px;
            color: #2b579a; /* Highlighted label color */
        }

        /* Submit button */
        button[type="submit"] {
            width: 100%;
            padding: 15px;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(90deg, #2b579a, #1d3f74); /* Gradient button background */
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        button[type="submit"]:hover {
            background: linear-gradient(90deg, #1d3f74, #2b579a); /* Reverse gradient on hover */
            transform: translateY(-3px); /* Slight lift effect */
        }

        /* Logout button */
        a.btn.btn-danger {
            display: inline-block;
            width: 100%;
            text-align: center;
            margin-top: 15px;
            padding: 15px;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(90deg, #d83b01, #a42800); /* Gradient red button */
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        a.btn.btn-danger:hover {
            background: linear-gradient(90deg, #a42800, #d83b01); /* Reverse gradient on hover */
            transform: translateY(-3px); /* Slight lift effect */
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 24px;
            }

            input, textarea {
                font-size: 14px;
            }

            button[type="submit"], a.btn.btn-danger {
                font-size: 14px;
                padding: 12px;
            }
        }

      /* Research Publications Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #f9fafb; /* Light background */
    border-radius: 8px; /* Rounded corners for the table */
    overflow: hidden; /* Ensure rounded edges apply to all table parts */
}

th, td {
    padding: 12px;
    text-align: left;
    border: 1px solid #ddd; /* Subtle border for clarity */
    font-size: 14px; /* Slightly smaller font for compact look */
    color: #333; /* Darker text for readability */
}

th {
    background-color: #dfe6f1; /* Light blue-gray header */
    color: #2b579a; /* Microsoft blue text color */
    font-weight: 600; /* Bolder text for headers */
    text-align: center; /* Center align header text */
}

tr:hover {
    background-color: #eef5ff; /* Highlighted row on hover */
}

td input {
    width: 95%; /* Slight padding from edges */
    padding: 8px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 4px; /* Slightly rounded edges for inputs */
    background-color: #f7f9fc; /* Light background for inputs */
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1); /* Subtle shadow inside inputs */
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

td input:focus {
    border-color: #2b579a; /* Microsoft blue for focused inputs */
    box-shadow: 0 0 5px rgba(43, 87, 154, 0.3); /* Blue glow effect */
    outline: none;
}

/* Add Publication and Remove Row Buttons */
button[type="button"] {
    padding: 6px 12px;
    font-size: 14px;
    color: #fff;
    background: linear-gradient(90deg, #2b579a, #1d3f74); /* Gradient for buttons */
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
}

button[type="button"]:hover {
    background: linear-gradient(90deg, #1d3f74, #2b579a); /* Reverse gradient on hover */
    transform: translateY(-2px); /* Slight lift effect */
}

button.remove-row {
    background: linear-gradient(90deg, #d83b01, #a42800); /* Red gradient for remove button */
}

button.remove-row:hover {
    background: linear-gradient(90deg, #a42800, #d83b01); /* Reverse red gradient */
}

/* Responsive table adjustments */
@media (max-width: 768px) {
    table {
        font-size: 12px; /* Smaller text on smaller screens */
    }

    th, td {
        padding: 10px;
    }

    td input {
        font-size: 12px;
        padding: 6px;
    }

    button[type="button"] {
        font-size: 12px;
        padding: 6px 10px;
    }
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Faculty Profile Generator</h1>
        <form action="save_profile.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" id="faculty_id" name="faculty_id" placeholder=" " required>
                <label for="faculty_id">Faculty ID:</label>
            </div>

            <div class="form-group">
                <input type="text" id="name" name="name" placeholder=" " required>
                <label for="name">Full Name:</label>
            </div>

            <div class="form-group">
                <input type="text" id="designation" name="designation" placeholder=" " required>
                <label for="designation">Designation:</label>
            </div>

            <div class="form-group">
                <input type="text" id="department" name="department" placeholder=" " required>
                <label for="department">Department:</label>
            </div>

            <div class="form-group">
                <textarea id="bio" name="bio" rows="4" placeholder=" " required></textarea>
                <label for="bio">Short Bio:</label>
            </div>

            <div class="form-group">
                <input type="text" id="expertise" name="expertise" placeholder=" " required>
                <label for="expertise">Areas of Expertise:</label>
            </div>

            <!-- Image Upload Section -->
            <div class="form-group">
                <input type="file" id="image" name="image" accept="image/*" required>
                <label for="image">Upload Profile Picture:</label>
            </div>

            <!-- Research Publications Table -->
            <div class="form-group">
                <label for="publications"></label>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Project Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="publication-rows">
                        <tr>
                            <td><input type="text" name="publication_name[]" placeholder="Publication Name" required></td>
                            <td><input type="text" name="project_name[]" placeholder="Project Name" required></td>
                            <td><input type="text" name="description[]" placeholder="Description" required></td>
                            <td><button type="button" class="remove-row" onclick="removeRow(this)">Remove</button></td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" onclick="addPublicationRow()">Add Publication</button>
            </div>

            <div class="form-group">
                <input type="text" id="experience" name="experience" placeholder=" " required>
                <label for="experience">Experience (in years):</label>
            </div>

            <div class="form-group">
                <input type="email" id="email" name="email" placeholder=" " required>
                <label for="email">Email:</label>
            </div>

            <div class="form-group">
                <input type="text" id="phone" name="phone" placeholder=" " required>
                <label for="phone">Phone Number:</label>
            </div>

            <button type="submit">Save Profile</button>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </form>
    </div>

    <script>
        // Function to add a new row for publications
        function addPublicationRow() {
            const tableBody = document.getElementById('publication-rows');
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
                <td><input type="text" name="publication_name[]" placeholder="Publication Name" required></td>
                <td><input type="text" name="project_name[]" placeholder="Project Name" required></td>
                <td><input type="text" name="description[]" placeholder="Description" required></td>
                <td><button type="button" class="remove-row" onclick="removeRow(this)">Remove</button></td>
            `;

            tableBody.appendChild(newRow);
        }

        // Function to remove a row
        function removeRow(button) {
            const row = button.parentElement.parentElement;
            row.remove();
        }
    </script>
</body>
</html>
