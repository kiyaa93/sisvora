<?php
include 'config.php'; // connection to database

header('Content-Type: application/json');

// AMBIL TOTAL KANDIDAT
$q1 = mysqli_query($conn, "SELECT COUNT(*) AS total FROM candidates");
$r1 = mysqli_fetch_assoc($q1);

// AMBIL TOTAL VOTERS
$q2 = mysqli_query($conn, "SELECT COUNT(*) AS total FROM voters");
$r2 = mysqli_fetch_assoc($q2);

// AMBIL YANG SUDAH VOTE
$q3 = mysqli_query($conn, "SELECT COUNT(*) AS total FROM voters WHERE status = 'Voted'");
$r3 = mysqli_fetch_assoc($q3);

$totalNotVoted = $r2['total'] - $r3['total'];

// AMBIL DATA LIVE RESULTS (PER KANDIDAT)
$results = [];
$getResults = mysqli_query($conn, "SELECT name, votes FROM candidates");
while($row = mysqli_fetch_assoc($getResults)){
    $percentage = ($r3['total'] > 0) ? ($row['votes'] / $r3['total']) * 100 : 0;
    $results[] = [
        'name' => $row['name'],
        'votes' => round($percentage, 2)
    ];
}

// =========================
// GET STATUS PEMILIHAN
// =========================
$election = mysqli_query($conn, "SELECT start_time, end_time FROM election_settings LIMIT 1");
$e = mysqli_fetch_assoc($election);

$current = strtotime("now");
$start   = strtotime($e['start_time']);
$end     = strtotime($e['end_time']);

if($current < $start){
    $status = "Upcoming";
} elseif($current >= $start && $current <= $end){
    $status = "Ongoing";
} else {
    $status = "Completed";
}

// RETURN JSON
echo json_encode([
    'success' => true,
    'data' => [
        'status' => $status,
        'totalCandidates' => $r1['total'],
        'totalVoters' => $r2['total'],
        'totalVoted' => $r3['total'],
        'totalNotVoted' => $totalNotVoted,
        'results' => $results
    ]
]);
?>