<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; color: #232323;">
    <h2>Your {{ $attempt->technology->name }} Skill Test Result</h2>
    <p>Hi {{ $attempt->name }},</p>
    <p>Thanks for taking the {{ $attempt->level->name }} level {{ $attempt->technology->name }} skill test. Here's how you did:</p>

    <table cellpadding="8" style="border-collapse: collapse; margin: 16px 0;">
        <tr>
            <td style="border: 1px solid #ddd;"><strong>Score</strong></td>
            <td style="border: 1px solid #ddd;">{{ $attempt->correct_answers }} / {{ $attempt->total_questions }} ({{ $attempt->score_percentage }}%)</td>
        </tr>
        <tr>
            <td style="border: 1px solid #ddd;"><strong>Result</strong></td>
            <td style="border: 1px solid #ddd;">{{ $attempt->score_percentage >= $attempt->level->pass_percentage ? 'Passed' : 'Not Passed' }}</td>
        </tr>
    </table>

    <p>Want to discuss your next project or role? Reply to this email or reach out directly.</p>
    <p>— Nirbhay Dhaked</p>
</body>
</html>
