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

        // Sort the cards
        sort(a.begin(), a.end());

        // Frequency map to count occurrences of each number
        unordered_map<int, int> freq;
        for (int i = 0; i < n; ++i) {
            freq[a[i]]++;
        }

        // Store unique values and their frequencies in a vector
        vector<pair<int, int>> uniqueFreq;
        for (const auto& p : freq) {
            uniqueFreq.push_back(p);
        }

        int maxCards = 0;
        int left = 0; // Left pointer for sliding window
        int currentSum = 0; // Current sum of frequencies in the window

        for (int right = 0; right < uniqueFreq.size(); ++right) {
            currentSum += uniqueFreq[right].second; // Add frequency of the right element

            // Maintain the window size to not exceed k distinct numbers
            while (right - left + 1 > k) {
                currentSum -= uniqueFreq[left].second; // Subtract frequency of the left element
                left++;
            }

            // Update maxCards with the current sum of frequencies
            maxCards = max(maxCards, currentSum);
        }

        // Output the result for this test case
        cout << maxCards << '\n';
    }

    return 0;
}
