yearChanged: function(e) {

    var year = e.currentYear

    $.ajax({
        url: absencesIndexUrl,
        type: "GET",
        success: function(response)
        {
            var absences = response.data;

            var currYearAllowed = calculateAnnualLeaveAllowed(doctorAnnualLeavesAllowed, doctorJoinYear, year);
            var currYearTaken = countAbsencesTaken(absences, "Annual leave", year);
            var prevTotalAllowed = totalAnnualLeaveAllowed(doctorAnnualLeavesAllowed, doctorJoinYear, (year-1));
            var prevTotalTaken = totalAnnualLeaveTaken(absences, doctorJoinYear, (year-1));
            var carriedOver = prevTotalAllowed - prevTotalTaken;
            var currTotalAllowed = currYearAllowed + carriedOver
            var notTaken = currTotalAllowed - currYearTaken;

            var trainingLeaveTaken = countAbsencesTaken(absences, "Training", year);
            var sickLeaveTaken = countAbsencesTaken(absences, 'Sick leave', year)
            var maternityLeaveTaken = countAbsencesTaken(absences, 'Maternity', year)
            var familyLeaveTaken = countAbsencesTaken(absences, 'Family', year)
            var bereavementLeaveTaken = countAbsencesTaken(absences, 'Bereavement', year)
            var otherLeaveTaken = countAbsencesTaken(absences, 'Other', year)
            var unpaidLeaveTaken = countAbsencesTaken(absences, 'Unpaid', year)

            $('#annual-leave-allowed').html(currYearAllowed);
            $('#annual-leave-carried-over').html((year > doctorJoinYear) ? carriedOver : 0)
            $('#annual-leave-total').html(currTotalAllowed + ' / ' + (notTaken ? notTaken : 0));
            $('#annual-leave-taken').html(currYearTaken);

            $('#training').html(trainingLeaveTaken)
            $('#sick-leave').html(sickLeaveTaken)
            $('#maternity').html(maternityLeaveTaken)
            $('#family').html(familyLeaveTaken)
            $('#bereavement').html(bereavementLeaveTaken)
            $('#other').html(otherLeaveTaken)
            $('#unpaid').html(unpaidLeaveTaken)
        }
    });
}