<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; color: #232323;">
    <h2>New Skill Test Lead</h2>
    <table cellpadding="8" style="border-collapse: collapse;">
        <tr><td style="border: 1px solid #ddd;"><strong>Name</strong></td><td style="border: 1px solid #ddd;">{{ $attempt->name }}</td></tr>
        <tr><td style="border: 1px solid #ddd;"><strong>Email</strong></td><td style="border: 1px solid #ddd;">{{ $attempt->email }}</td></tr>
        <tr><td style="border: 1px solid #ddd;"><strong>Phone</strong></td><td style="border: 1px solid #ddd;">{{ $attempt->phone }}</td></tr>
        <tr><td style="border: 1px solid #ddd;"><strong>Technology</strong></td><td style="border: 1px solid #ddd;">{{ $attempt->technology->name }}</td></tr>
        <tr><td style="border: 1px solid #ddd;"><strong>Level</strong></td><td style="border: 1px solid #ddd;">{{ $attempt->level->name }}</td></tr>
        <tr><td style="border: 1px solid #ddd;"><strong>Score</strong></td><td style="border: 1px solid #ddd;">{{ $attempt->correct_answers }} / {{ $attempt->total_questions }} ({{ $attempt->score_percentage }}%)</td></tr>
    </table>
</body>
</html>
