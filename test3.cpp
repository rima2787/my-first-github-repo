#include <iostream>
#include <vector>
#include <unordered_map>
#include <algorithm>

using namespace std;

int main() {
    ios::sync_with_stdio(false);
    cin.tie(0);

    int t;
    cin >> t;

    while (t--) {
        int n, k;
        cin >> n >> k;
        vector<int> a(n);

        // Read the cards
        for (int i = 0; i < n; ++i) {
            cin >> a[i];
        }

        // Sort the vector
        sort(a.begin(), a.end());

        // Calculate frequency of each number
        unordered_map<int, int> freq;
        for (int i = 0; i < n; ++i) {
            freq[a[i]]++;
        }

        // Store unique values and their frequencies
        vector<pair<int, int>> uniqueFreq; // pair<value, frequency>
        for (const auto& p : freq) {
            uniqueFreq.push_back(p);
        }

        // Sliding window to find the maximum sum of k consecutive frequencies
        int maxCards = 0;
        int currentSum = 0;
        int left = 0;

        for (int right = 0; right < uniqueFreq.size(); ++right) {
            currentSum += uniqueFreq[right].second; // Add the frequency of the right end

            // If we have more than k elements in the window, move the left end
            while (right - left + 1 > k) {
                currentSum -= uniqueFreq[left].second; // Subtract the frequency of the left end
                left++;
            }

            // Update the maximum cards taken
            maxCards = max(maxCards, currentSum);
        }

        // Output the result for this test case
        cout << maxCards << '\n';
    }

    return 0;
}
