<?php

// Path to your local repository
$repoPath = '/Applications/XAMPP/xamppfiles/htdocs/Laravel-Open-Source-Projects';  // Change this to your actual repo path

// GitHub repository info
$gitUserName = 'dan1sssimo'; // Set your Git username
$gitUserEmail = 'danilo.savchenko96@gmail.com'; // Set your Git email

// Create or modify a dummy file for each commit
function createFile($filePath, $content)
{
    file_put_contents($filePath, $content); // Overwrite the file with new content
}

// Execute Git commands
function executeGitCommand($command)
{
    global $repoPath;
    $command = "cd $repoPath && $command";
    return shell_exec($command);
}

// Set user credentials for Git
executeGitCommand("git config --global user.name '$gitUserName'");
executeGitCommand("git config --global user.email '$gitUserEmail'");

// Start date (e.g., 1 month ago)
$startDate = strtotime('2025-01-01');  // Change the start date if needed

// Number of commits you want to create
$numCommits = 1000;

$filePath = "$repoPath/dummy_file.txt";  // We'll modify this file for each commit

for ($i = 0; $i < $numCommits; $i++) {
    // Generate commit date (incrementing each commit by one day)
    $commitDate = date('Y-m-d H:i:s', $startDate + ($i * 86400)); // 86400 seconds = 1 day
    $commitMessage = "Commit #$i";

    // Modify the file content for each commit
    $content = "This is commit number $i. The current date is " . date('Y-m-d H:i:s') . "\n";
    createFile($filePath, $content);  // Overwrite the file with the new content

    // Add the modified file to Git
    executeGitCommand('git add .');

    // Commit with the custom date
    executeGitCommand("git commit --date='$commitDate' -m '$commitMessage'");

    // Push the commit to the remote repository
    executeGitCommand('git push origin master');

    // Optional: Add a short delay between commits
    usleep(500000);  // 0.5 second delay
}

echo "Successfully created $numCommits commits.\n";
?>
