# SYSARCHPROJ - MVC CRUD Application

#  Project Overview
This is an MVC-based CRUD application developed for the SYSARCH32 Midterm Project. 
It includes Git and GitHub integration for version control.

---

# Project Setup Instructions
git init 
# initialize
git remote add origin https://github.com/Christian0162/Midterm_Project_SCM 
git add .
git commit -m "INITIALIZED COMMIT: Added MVC-Crud"
git push -u origin main -f

# Clone the Repository

git clone https://github.com/your-username/your-repo.git
cd Midterm_Project_SCM

composer install
php artisan serve

# Git workflow explanation

To Implement Git Branching & Workflow
me and my partner will each create at least two feature branches for different tasks using the command:
`git checkout -b feature-branch-name`
This ensures that we can work on separate features without interfering with the main branch.

Once we complete our assigned tasks, we will stage and commit the changes using:
`git add .`
`git commit -m "Added CollegeController"`

After committing, we will push our feature branches to the remote repository with:
`git push origin Christian`
`git push origin Clarence`
Then, we will create a Pull Request (PR) to propose merging our feature branch into the main branch.

after, for the Pull Requests & Code Reviews
-me and my partner will review each other’s PRs to check for code quality and functionality.
If necessary, we will provide feedback through comments.
Before merging, we must resolve any conflicts to ensure a smooth integration.
Only after addressing all issues will we approve and merge the feature branch into the main branch.
