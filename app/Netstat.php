<?php


class Netstat
{

    public static function parseArgs($ssOutput)
    {
        $lines = explode("\n", $ssOutput);

        // Step 2: Skip the header line
        array_shift($lines);

        // Step 3: Parse each line and extract relevant details
        $connections = [];
        foreach ($lines as $line) {
            // Ignore empty lines
            if (empty(trim($line))) {
                continue;
            }

            // Use regex to match the structured output
            if (preg_match('/(\S+)\s+(\d+)\s+(\d+)\s+(\S+)\s+(\S+)\s+users:\(\("([^"]+)",pid=(\d+),fd=(\d+)\)\)/', $line, $matches)) {
                $connections[] = [
                    'State' => $matches[1],                  // e.g., LISTEN
                    'Recv-Q' => $matches[2],                  // e.g., 0
                    'Send-Q' => $matches[3],                  // e.g., 128
                    'LocalAddress' => $matches[4],            // e.g., 0.0.0.0:80
                    'ForeignAddress' => $matches[5],          // e.g., 0.0.0.0:*
                    'Program' => $matches[6],                 // e.g., nginx
                    'PID' => $matches[7],                     // e.g., 1234
                    'FD' => $matches[8],                      // e.g., 6
                ];
            }
        }
        return $connections;

    }
}

